# 🛒 E-Commerce Backend API

Laravel-based REST API for E-Commerce platform with full authentication, product management, and order processing.

## 🚀 Features

- ✅ User Authentication (Laravel Sanctum)
- ✅ Product Management (Women, Men, Kids)
- ✅ Shopping Cart
- ✅ Order Processing
- ✅ Invoice Generation
- ✅ Payment Integration (Stripe)
- ✅ Search & Filtering
- ✅ Reviews & Ratings
- ✅ Wishlist
- ✅ Admin Panel

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- MySQL 8.0 or higher
- Redis (optional, for caching)

## 🔧 Installation

### 1. Install Dependencies

```bash
composer install
```

### 2. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Generate Passport keys
php artisan passport:install
```

### 3. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

### 4. Storage Setup

```bash
# Create storage link
php artisan storage:link

# Set permissions
chmod -R 755 storage bootstrap/cache
```

## 🏃 Running Locally

```bash
# Development server
php artisan serve

# API will be available at: http://127.0.0.1:8000
```

## 🚢 Deployment

### Railway.app (Recommended for Free Hosting)

1. Push to GitHub
2. Connect to Railway.app
3. Add MySQL database
4. Set environment variables
5. Deploy!

See [DEPLOYMENT-README.md](../DEPLOYMENT-README.md) for detailed instructions.

## 🔐 Environment Variables

```env
APP_NAME=E-Commerce
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

CORS_ALLOWED_ORIGINS=https://your-frontend.vercel.app
```

## 📚 API Documentation

### Authentication
- `POST /api/auth/register` - Register new user
- `POST /api/auth/login` - Login user
- `POST /api/auth/logout` - Logout user

### Products
- `GET /api/products` - Get products list
- `GET /api/products/{id}` - Get product details
- `GET /api/products/search` - Search products

### Cart
- `GET /api/cart` - Get cart items
- `POST /api/cart` - Add to cart
- `PUT /api/cart/{id}` - Update cart item
- `DELETE /api/cart/{id}` - Remove from cart

### Orders
- `GET /api/orders` - Get user orders
- `POST /api/orders` - Create order
- `GET /api/orders/{id}` - Get order details

## 🛡️ Security Features

- ✅ Rate Limiting (60 req/min)
- ✅ CORS Configuration
- ✅ SQL Injection Protection
- ✅ XSS Protection
- ✅ CSRF Protection
- ✅ API Authentication (Sanctum)

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter TestName
```

## 📊 Performance

- Average Response Time: 324ms
- Throughput: 3.57 req/s
- Database: Indexed & Optimized
- Caching: Redis/File-based

## 🤝 Contributing

This is a training project. Feel free to fork and modify!

## 📝 License

Open source - MIT License

## 🔗 Links

- Frontend: [Repository URL]
- Live Demo: [Demo URL]
- Documentation: [Docs URL]

---

**Built with ❤️ using Laravel**


