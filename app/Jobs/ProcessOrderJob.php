<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300;
    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Order $order
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('Processing order', ['order_id' => $this->order->id]);

            // Update order status to processing
            $this->order->update(['status' => 'processing']);

            // Check product availability
            $this->checkProductAvailability();

            // Reserve products
            $this->reserveProducts();

            // Send order confirmation email
            $this->sendOrderConfirmation();

            // Update order status to confirmed
            $this->order->update(['status' => 'confirmed']);

            Log::info('Order processed successfully', ['order_id' => $this->order->id]);
        } catch (\Exception $e) {
            Log::error('Order processing failed', [
                'order_id' => $this->order->id,
                'error' => $e->getMessage(),
            ]);

            // Update order status to failed
            $this->order->update(['status' => 'failed']);

            throw $e;
        }
    }

    /**
     * Check product availability.
     */
    private function checkProductAvailability(): void
    {
        foreach ($this->order->items as $item) {
            $product = Product::find($item->product_id);
            
            if (!$product || $product->stock_quantity < $item->quantity) {
                throw new \Exception("Insufficient stock for product: {$product->name}");
            }
        }
    }

    /**
     * Reserve products.
     */
    private function reserveProducts(): void
    {
        foreach ($this->order->items as $item) {
            $product = Product::find($item->product_id);
            $product->decrement('stock_quantity', $item->quantity);
        }
    }

    /**
     * Send order confirmation.
     */
    private function sendOrderConfirmation(): void
    {
        $notificationService = app(NotificationService::class);
        
        $notificationService->sendEmailNotification(
            $this->order->user,
            'Order Confirmation - ' . $this->order->order_number,
            'emails.order-confirmation',
            ['order' => $this->order]
        );
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Order processing job failed permanently', [
            'order_id' => $this->order->id,
            'error' => $exception->getMessage(),
        ]);

        // Update order status to failed
        $this->order->update(['status' => 'failed']);

        // Send failure notification
        $notificationService = app(NotificationService::class);
        $notificationService->sendNotification($this->order->user, [
            'type' => 'order_failed',
            'title' => 'Order Processing Failed',
            'message' => 'Your order could not be processed. Please contact support.',
            'data' => ['order_id' => $this->order->id],
        ]);
    }
}
