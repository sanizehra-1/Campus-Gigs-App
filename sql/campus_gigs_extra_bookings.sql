-- ============================================================
-- Campus Gigs — Extra Bookings for My Gigs Demo
-- Run in phpMyAdmin SQL tab
-- Adds bookings where user 6 (Zain Ahmed) is ALSO a seller
-- so the My Gigs tab has real data to show
-- ============================================================

USE campus_gigs;

-- First make Zain Ahmed also a Freelancer so he can sell
UPDATE users SET user_type = 'Freelancer' WHERE user_id = 6;

-- Add a service listed BY Zain Ahmed (user_id 6)
INSERT INTO services (seller_id, category_id, title, description, price, image_url)
VALUES (6, 1, 'Arduino Project Help', 'Complete Arduino projects with circuit diagrams and code.', 1100.00, 'https://images.unsplash.com/photo-1553406830-ef2513450d76?w=400&q=80');

-- Get the new service_id (should be 21 if 20 existed before)
-- Add bookings ON that service from other users
INSERT INTO bookings (buyer_id, service_id, booking_date, status) VALUES
  (7,  21, '2025-04-01', 'Pending'),
  (8,  21, '2025-04-03', 'Confirmed'),
  (9,  21, '2025-03-20', 'Completed'),
  (10, 21, '2025-03-15', 'Completed');

-- Add a review for one of the completed bookings
-- (booking_id will be the last inserted — check and adjust if needed)
-- This adds a review for the 3rd booking above (buyer_id=9, Completed)
INSERT INTO reviews (booking_id, rating, comment)
SELECT b.booking_id, 5, 'Zain explained everything perfectly, circuit worked first try!'
FROM bookings b WHERE b.service_id = 21 AND b.buyer_id = 9 LIMIT 1;
