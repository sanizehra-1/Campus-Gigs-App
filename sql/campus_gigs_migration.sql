-- ============================================================
-- Campus Gigs — Migration: Add image_url to services
-- Run this ONCE in phpMyAdmin or MySQL Workbench
-- ============================================================

USE campus_gigs;

ALTER TABLE services
ADD COLUMN image_url VARCHAR(500) DEFAULT '' AFTER price;

-- Optional: add some real images to existing services
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=400&q=80' WHERE service_id = 1;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1593720219276-0b1eacd0aef4?w=400&q=80' WHERE service_id = 2;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1593720219276-0b1eacd0aef4?w=400&q=80' WHERE service_id = 3;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1593720219276-0b1eacd0aef4?w=400&q=80' WHERE service_id = 4;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=400&q=80' WHERE service_id = 5;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=400&q=80' WHERE service_id = 6;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=400&q=80' WHERE service_id = 7;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=400&q=80' WHERE service_id = 8;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=400&q=80' WHERE service_id = 9;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1611162616305-c69b3fa7fbe0?w=400&q=80' WHERE service_id = 10;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=400&q=80' WHERE service_id = 11;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=400&q=80' WHERE service_id = 12;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=400&q=80' WHERE service_id = 13;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&q=80' WHERE service_id = 14;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=400&q=80' WHERE service_id = 15;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=400&q=80' WHERE service_id = 16;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1593720219276-0b1eacd0aef4?w=400&q=80' WHERE service_id = 17;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=400&q=80' WHERE service_id = 18;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=400&q=80' WHERE service_id = 19;
UPDATE services SET image_url = 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=400&q=80' WHERE service_id = 20;
