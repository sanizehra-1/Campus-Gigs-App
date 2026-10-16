-- ============================================================
-- Campus Gigs — DML Seed Script
-- Run AFTER campus_gigs_schema.sql
-- ============================================================

USE campus_gigs;

-- ── Categories ────────────────────────────────────────────
INSERT INTO categories (category_name) VALUES
    ('Tech & Code'),
    ('Academics'),
    ('Creative'),
    ('Business');

-- ── Users (15 students + freelancers) ────────────────────
INSERT INTO users (full_name, email, user_type) VALUES
    ('Ayesha Khalid',    'ayesha.khalid@iobm.edu.pk',   'Freelancer'),
    ('Bilal Raza',       'bilal.raza@iobm.edu.pk',      'Freelancer'),
    ('Sana Mirza',       'sana.mirza@iobm.edu.pk',      'Freelancer'),
    ('Usman Tariq',      'usman.tariq@iobm.edu.pk',     'Freelancer'),
    ('Hira Baig',        'hira.baig@iobm.edu.pk',       'Freelancer'),
    ('Zain Ahmed',       'zain.ahmed@iobm.edu.pk',      'Student'),
    ('Fatima Sheikh',    'fatima.sheikh@iobm.edu.pk',   'Student'),
    ('Omar Siddiqui',    'omar.siddiqui@iobm.edu.pk',   'Student'),
    ('Nadia Hussain',    'nadia.hussain@iobm.edu.pk',   'Student'),
    ('Kamran Ali',       'kamran.ali@iobm.edu.pk',      'Student'),
    ('Iqra Farooq',      'iqra.farooq@iobm.edu.pk',    'Student'),
    ('Asad Mehmood',     'asad.mehmood@iobm.edu.pk',   'Student'),
    ('Mehwish Javed',    'mehwish.javed@iobm.edu.pk',   'Student'),
    ('Talha Nawaz',      'talha.nawaz@iobm.edu.pk',     'Student'),
    ('Rabia Chaudhry',   'rabia.chaudhry@iobm.edu.pk',  'Student');

-- ── Services (20 listings) ───────────────────────────────
-- seller_ids 1-5 are Freelancers; category_ids match above
INSERT INTO services (seller_id, category_id, title, description, price) VALUES
    (1, 1, 'Python Lab Help',        'Debug & complete your Python assignments with explanations.',  800.00),
    (1, 1, 'Web Scraping Script',    'Custom BeautifulSoup / Selenium scraper for any website.',    1200.00),
    (2, 1, 'Java Project Rescue',    'Fix compilation errors and logic bugs in Java projects.',      950.00),
    (2, 1, 'React Landing Page',     'Build a responsive single-page React app from a Figma file.', 2500.00),
    (3, 2, 'Economics Assignment',   'Detailed solutions with graphs for micro/macro eco tasks.',    600.00),
    (3, 2, 'Stats Homework Help',    'SPSS / Excel-based statistical analysis with interpretation.', 750.00),
    (3, 2, 'English Proofreading',   'Grammar, style & citation review for reports up to 3000 words.', 400.00),
    (4, 2, 'Research Paper Writing', 'Full draft in APA / Harvard format — plagiarism-free.',       1800.00),
    (4, 3, 'Logo Design (3 Concepts)','Modern minimalist logos delivered in AI & PNG.',            1500.00),
    (4, 3, 'Instagram Post Pack',    '10 branded social media graphics in Canva / Illustrator.',   1100.00),
    (5, 3, 'CV & Resume Design',     'ATS-friendly, visually polished CV in PDF & Word.',           700.00),
    (5, 3, 'Presentation Design',    '15-slide pitch deck with animations — PowerPoint or Google.', 1300.00),
    (1, 4, 'Business Plan Draft',    'Executive summary, market analysis, and financial overview.', 2200.00),
    (2, 4, 'SWOT Analysis Report',   'Detailed SWOT with competitor benchmarking.',                  900.00),
    (3, 4, 'Marketing Strategy',     'Digital marketing plan with social and SEO roadmap.',         1600.00),
    (4, 1, 'SQL Database Design',    'Normalised schema design with ER diagram for MySQL.',          1000.00),
    (5, 1, 'Excel VBA Automation',   'Automate repetitive Excel tasks with macros.',                 850.00),
    (1, 3, 'Photo Editing (10 pics)','Professional colour grading and retouching in Lightroom.',    650.00),
    (2, 2, 'Accounting Help',        'Journal entries, T-accounts, and trial balance solutions.',    700.00),
    (5, 4, 'Freelance Profile Setup','Complete Fiverr / Upwork profile written and optimised.',     500.00);

-- ── Bookings (15 bookings) ───────────────────────────────
-- buyer_ids 6-15 are Students
INSERT INTO bookings (buyer_id, service_id, booking_date, status) VALUES
    (6,  1,  '2025-03-01', 'Completed'),
    (7,  5,  '2025-03-03', 'Completed'),
    (8,  9,  '2025-03-05', 'Completed'),
    (9,  12, '2025-03-08', 'Completed'),
    (10, 7,  '2025-03-10', 'Completed'),
    (11, 16, '2025-03-12', 'Completed'),
    (12, 3,  '2025-03-15', 'Completed'),
    (13, 19, '2025-03-18', 'Completed'),
    (6,  4,  '2025-04-01', 'Confirmed'),
    (7,  13, '2025-04-03', 'Confirmed'),
    (8,  17, '2025-04-05', 'Confirmed'),
    (9,  11, '2025-04-07', 'Confirmed'),
    (14, 2,  '2025-04-10', 'Pending'),
    (15, 20, '2025-04-12', 'Pending'),
    (10, 15, '2025-04-15', 'Pending');

-- ── Reviews (8 reviews for Completed bookings 1-8) ───────
INSERT INTO reviews (booking_id, rating, comment) VALUES
    (1, 5, 'Ayesha explained every line of code — my best lab submission ever!'),
    (2, 4, 'Economics solutions were thorough and well-referenced. Highly recommended.'),
    (3, 5, 'Beautiful logo, exactly the minimalist style I wanted. Super fast delivery.'),
    (4, 4, 'Presentation looked very professional. Minor revisions needed but sorted quickly.'),
    (5, 5, 'Proofreading was detailed — even fixed my citation format. Will come back.'),
    (6, 3, 'SQL schema was correct but took a bit longer than expected. Good quality overall.'),
    (7, 5, 'Java project fixed within 2 hours! Saved my semester, genuinely grateful.'),
    (8, 4, 'Accounting solutions clear and easy to follow for revision. Great seller.');
