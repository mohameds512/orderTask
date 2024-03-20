
after getting the code create DB 'OrderDB' then 
 run the following command
 -composer i
 -php artisan migrate --seed
 -php artisan serve
 then use 'http://localhost:8000/api/register' to register
    with email: 'admin@example.com' and password: '12345678'
    use generated token for Authorization 
 use 'http://localhost:8000/api/product/index' to access the products

be sure to use php 8.2


the following are the completion of the task

Part 2: Query Writing
1. Task 1:
    SELECT 
        users.name,
        users.email,
        SUM(purchases.amount) AS total_amount_spent
    FROM 
        users
    JOIN 
        purchases ON users.user_id = purchases.user_id
    WHERE 
        purchases.purchase_date >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)
    GROUP BY 
        users.user_id;

2. Task 2:

    SELECT 
        purchases.product_name,
        SUM(purchases.quantity) AS total_quantity_sold,
        AVG(purchases.rating) AS average_rating
    FROM 
        purchases
    JOIN 
        products ON products.product_id = purchases.product_id
    GROUP BY 
        purchases.product_id
    ORDER BY 
        total_quantity_sold DESC
    LIMIT 
        5;



Part 3: Query Refactoring

    $orders = Order::with(['orderItems.product.category'])
        ->whereHas('orderItems.product.category', function ($query) {
            $query->where('name', 'Electronics');
        })
        ->where('created_at', '>', now()->subDays(30))
        ->orderByDesc('created_at')
        ->limit(10)
        ->get();
