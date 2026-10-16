-- ============================================================
-- Campus Gigs — DDL Script
-- Run this first in MySQL Workbench to create all tables
-- ============================================================

CREATE DATABASE IF NOT EXISTS campus_gigs;
USE campus_gigs;

-- 1. Users
CREATE TABLE users (
    user_id    INT           NOT NULL AUTO_INCREMENT,
    full_name  VARCHAR(100)  NOT NULL,
    email      VARCHAR(150)  NOT NULL UNIQUE,
    user_type  ENUM('Student','Freelancer') NOT NULL,
    PRIMARY KEY (user_id)
);

-- 2. Categories
CREATE TABLE categories (
    category_id   INT          NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(80)  NOT NULL,
    PRIMARY KEY (category_id)
);

-- 3. Services
CREATE TABLE services (
    service_id  INT            NOT NULL AUTO_INCREMENT,
    seller_id   INT            NOT NULL,
    category_id INT            NOT NULL,
    title       VARCHAR(150)   NOT NULL,
    description TEXT,
    price       DECIMAL(8,2)   NOT NULL,
    PRIMARY KEY (service_id),
    CONSTRAINT fk_services_seller
        FOREIGN KEY (seller_id)   REFERENCES users(user_id)      ON DELETE CASCADE,
    CONSTRAINT fk_services_category
        FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);

-- 4. Bookings
CREATE TABLE bookings (
    booking_id   INT  NOT NULL AUTO_INCREMENT,
    buyer_id     INT  NOT NULL,
    service_id   INT  NOT NULL,
    booking_date DATE NOT NULL,
    status       ENUM('Pending','Confirmed','Completed') NOT NULL DEFAULT 'Pending',
    PRIMARY KEY (booking_id),
    CONSTRAINT fk_bookings_buyer
        FOREIGN KEY (buyer_id)   REFERENCES users(user_id)    ON DELETE CASCADE,
    CONSTRAINT fk_bookings_service
        FOREIGN KEY (service_id) REFERENCES services(service_id) ON DELETE CASCADE
);

-- 5. Reviews
CREATE TABLE reviews (
    review_id  INT  NOT NULL AUTO_INCREMENT,
    booking_id INT  NOT NULL,
    rating     INT  NOT NULL,
    comment    TEXT,
    PRIMARY KEY (review_id),
    CONSTRAINT fk_reviews_booking
        FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) ON DELETE CASCADE,
    CONSTRAINT chk_rating CHECK (rating BETWEEN 1 AND 5)
);
