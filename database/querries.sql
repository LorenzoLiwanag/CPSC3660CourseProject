-- Note:
-- For each query below, the corresponding business question is listed first, followed by the SQL statement used to answer that question.

-- Query 1
-- What vehicles are currently available for sale?

SELECT vehicle_id, make, model, year, color, miles, `condition`, book_price, style, interior_color, status
FROM Vehicle
WHERE status = 'Available'
ORDER BY make, model, year;

-- Query 2
-- What is the complete inventory of all vehicles in the system?

SELECT vehicle_id, make, model, year, color, miles, `condition`, book_price, style, interior_color, status
FROM Vehicle
ORDER BY vehicle_id;

-- Query 3
-- What customers are currently stored in the system?

SELECT customer_id, first_name, last_name, phone, city, state, number_of_late_payments, average_days_late
FROM Customer
ORDER BY last_name, first_name;

-- Query 4
-- What warranty policies does JonesAuto currently offer?

SELECT policy_id, policy_name, component_type, standard_length, standard_cost, standard_deductible
FROM Warranty_Policy
ORDER BY policy_id;

-- Query 5
-- What vehicles were purchased, from whom, and for how much?

SELECT purchase_id, vehicle_id, buyer_id, seller_id, purchase_date, location, is_auction, price_paid
FROM Purchase
ORDER BY purchase_date DESC;

-- Query 6
-- Which vehicles were sold, to which customers, and by which salespersons?

SELECT 
    s.sale_id,
    s.vehicle_id,
    v.make,
    v.model,
    v.year,
    c.customer_id,
    c.first_name AS customer_first_name,
    c.last_name AS customer_last_name,
    sp.salesperson_id,
    sp.first_name AS salesperson_first_name,
    sp.last_name AS salesperson_last_name,
    s.sale_date,
    s.total_due,
    s.down_payment,
    s.financed_amount,
    s.sale_price,
    s.salesperson_commission
FROM Sale s
JOIN Vehicle v ON s.vehicle_id = v.vehicle_id
JOIN Customer c ON s.customer_id = c.customer_id
JOIN Salesperson sp ON s.salesperson_id = sp.salesperson_id
ORDER BY s.sale_date DESC, s.sale_id DESC;

-- Query 7
-- What warranty sales were made, and which policy, customer, vehicle, and salesperson were involved?

SELECT
    ws.warranty_sale_id,
    ws.sale_id,
    ws.vehicle_id,
    v.make,
    v.model,
    v.year,
    ws.customer_id,
    c.first_name AS customer_first_name,
    c.last_name AS customer_last_name,
    ws.salesperson_id,
    sp.first_name AS salesperson_first_name,
    sp.last_name AS salesperson_last_name,
    ws.policy_id,
    wp.policy_name,
    wp.component_type,
    ws.warranty_sale_date,
    ws.warranty_start_date,
    ws.warranty_length,
    ws.deductible,
    ws.total_cost,
    ws.monthly_cost,
    ws.paid_upfront_flag
FROM Warranty_Sale ws
JOIN Warranty_Policy wp ON ws.policy_id = wp.policy_id
JOIN Vehicle v ON ws.vehicle_id = v.vehicle_id
JOIN Customer c ON ws.customer_id = c.customer_id
JOIN Salesperson sp ON ws.salesperson_id = sp.salesperson_id
ORDER BY ws.warranty_sale_date DESC, ws.warranty_sale_id DESC;

-- Query 8
-- What payments have customers made, and which customer made each payment?

SELECT
    p.payment_id,
    p.customer_id,
    c.first_name AS customer_first_name,
    c.last_name AS customer_last_name,
    p.sale_id,
    p.payment_date,
    p.due_date,
    p.paid_date,
    p.amount,
    p.bank_account
FROM Payment p
JOIN Customer c ON p.customer_id = c.customer_id
ORDER BY p.payment_date DESC, p.payment_id DESC;

-- Query 9
-- Which salespersons earned the highest commissions, and how many sales did each complete?

SELECT 
    sp.salesperson_id,
    sp.first_name,
    sp.last_name,
    COUNT(s.sale_id) AS total_sales,
    SUM(s.salesperson_commission) AS total_commission,
    AVG(s.salesperson_commission) AS avg_commission,
    MAX(s.salesperson_commission) AS highest_commission
FROM Salesperson sp
LEFT JOIN Sale s ON sp.salesperson_id = s.salesperson_id
GROUP BY sp.salesperson_id, sp.first_name, sp.last_name
ORDER BY total_commission DESC;

-- Query 10
-- How much profit did JonesAuto make on each vehicle that was purchased and later sold?

SELECT 
    v.vehicle_id,
    v.make,
    v.model,
    v.year,
    pu.price_paid AS purchase_price,
    s.sale_price,
    (s.sale_price - pu.price_paid) AS profit,
    ROUND(((s.sale_price - pu.price_paid) / pu.price_paid * 100), 2) AS profit_margin_percent,
    pu.purchase_date,
    s.sale_date,
    DATEDIFF(s.sale_date, pu.purchase_date) AS days_held
FROM Vehicle v
JOIN Purchase pu ON v.vehicle_id = pu.vehicle_id
JOIN Sale s ON v.vehicle_id = s.vehicle_id
ORDER BY profit DESC;