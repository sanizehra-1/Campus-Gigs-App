<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Campus Gigs — IoBM Student Marketplace</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --pd: #9B89B4; --ps: #B8A9CC; --pp: #E8E2F3;
      --pk: #6B5A87; --ch: #4A4558; --ink: #2E2A3B;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family:'Nunito',sans-serif; background:#F2F2F2; color:#4A4558;
      background-image: repeating-linear-gradient(0deg,transparent,transparent 28px,rgba(155,137,180,.04) 29px),
                        repeating-linear-gradient(90deg,transparent,transparent 28px,rgba(155,137,180,.04) 29px); }

    /* ── Nav ── */
    .navbar { background:#fff; border-bottom:2px solid var(--pp); position:sticky; top:0; z-index:100;
              display:flex; align-items:center; justify-content:space-between; padding:0 32px; height:64px; }
    .logo { font-family:'Caveat',cursive; font-size:1.8rem; font-weight:700; color:var(--pk); text-decoration:none; }
    .logo span { color:var(--ps); }
    .nav-links { display:flex; gap:32px; }
    .nav-link { font-size:.875rem; font-weight:600; color:var(--ch); text-decoration:none; cursor:pointer;
                padding-bottom:2px; border-bottom:2px solid transparent; transition:.2s; background:none; border-top:none; border-left:none; border-right:none; }
    .nav-link:hover,.nav-link.active { color:var(--pk); border-bottom-color:var(--ps); }
    .nav-actions { display:flex; align-items:center; gap:12px; }

    /* ── Buttons ── */
    .btn { font-family:'Caveat',cursive; font-weight:700; cursor:pointer; transition:.18s; border:2px solid; }
    .btn-primary { background:var(--pd); color:#fff; border-color:var(--pk);
      border-radius:10px 7px 12px 8px/8px 12px 7px 10px; padding:9px 22px; font-size:1.05rem; }
    .btn-primary:hover { transform:rotate(-1.5deg) scale(1.03); box-shadow:3px 4px 0 var(--pk); }
    .btn-outline { background:transparent; color:var(--pk); border-color:var(--ps);
      border-radius:8px 5px 10px 6px/6px 10px 5px 8px; padding:7px 18px; font-size:1rem; }
    .btn-outline:hover { background:var(--pp); animation:wiggle .4s ease; }
    .btn-ghost { background:none; border:none; color:var(--ch); font-family:'Nunito',sans-serif; font-size:.85rem; font-weight:600; cursor:pointer; }
    .btn-ghost:hover { color:var(--pk); }
    .btn-danger { background:#fee2e2; color:#dc2626; border-color:#fca5a5;
      border-radius:8px; padding:6px 14px; font-family:'Nunito',sans-serif; font-size:.78rem; font-weight:700; cursor:pointer; }
    @keyframes wiggle { 0%{transform:rotate(0)} 25%{transform:rotate(-4deg)} 50%{transform:rotate(4deg)} 75%{transform:rotate(-2deg)} 100%{transform:rotate(0)} }

    /* ── Pages ── */
    .page { display:none; }
    .page.active { display:block; }

    /* ── Hero ── */
    .hero { background:var(--pp); border-bottom:2px dashed var(--ps); padding:60px 24px 68px; text-align:center; position:relative; overflow:hidden; }
    .hero-title { font-family:'Caveat',cursive; font-size:clamp(2.2rem,5.5vw,3.4rem); font-weight:700; color:var(--ink); line-height:1.2; margin-bottom:10px; }
    .hero-sub { font-size:.95rem; color:var(--ch); max-width:460px; margin:0 auto 28px; line-height:1.7; }
    .sparkle { position:absolute; pointer-events:none; font-family:'Caveat',cursive; color:var(--pd); opacity:.3; animation:flt 4s ease-in-out infinite; }
    @keyframes flt { 0%,100%{transform:translateY(0) rotate(0)} 50%{transform:translateY(-10px) rotate(15deg)} }

    /* ── Search ── */
    .search-wrap { background:#fff; border:2px solid var(--ps);
      border-radius:14px 10px 16px 12px/12px 16px 10px 14px;
      display:flex; align-items:center; max-width:620px; margin:0 auto 18px;
      box-shadow:4px 4px 0 rgba(155,137,180,.2); overflow:hidden; }
    .search-wrap input { flex:1; border:none; outline:none; padding:14px 16px; font-family:'Nunito',sans-serif; font-size:.9rem; color:var(--ink); }
    .search-wrap input::placeholder { color:#b0a8c0; }

    /* ── Category pills ── */
    .cat-pill { display:inline-flex; align-items:center; gap:6px; padding:7px 16px 7px 12px;
      background:#fff; border:2px solid var(--ps); border-radius:999px;
      font-size:.8rem; font-weight:700; color:var(--ch); cursor:pointer; transition:.2s; }
    .cat-pill .icon { display:inline-flex; align-items:center; justify-content:center;
      width:26px; height:26px; border-radius:50%; outline:3px solid #fff;
      box-shadow:0 2px 6px rgba(107,90,135,.3),0 0 0 3px #fff; font-size:13px; flex-shrink:0; }
    .cat-pill:hover,.cat-pill.active { background:var(--pp); border-color:var(--pk); color:var(--pk); transform:rotate(-1.5deg) scale(1.04); box-shadow:2px 3px 0 var(--ps); }

    /* ── Service card ── */
    .service-card { background:#fff; border:2px solid #d8d0e8;
      border-radius:14px 10px 16px 11px/11px 16px 10px 14px;
      overflow:hidden; break-inside:avoid; margin-bottom:18px;
      transition:transform .2s,box-shadow .2s; position:relative; cursor:pointer; }
    .service-card::before { content:''; position:absolute; top:-2px; right:14px; width:28px; height:9px; background:rgba(184,169,204,.45); border-radius:0 0 4px 4px; z-index:2; }
    .service-card:hover { transform:rotate(.6deg) translateY(-3px); box-shadow:5px 6px 0 rgba(155,137,180,.28); }
    .card-img { width:100%; height:160px; object-fit:cover; display:block; }
    .card-img-placeholder { width:100%; height:140px; background:linear-gradient(135deg,var(--pp),#ddd8f0); display:flex; align-items:center; justify-content:center; font-size:2.5rem; }
    .card-body { padding:14px; }
    .cat-label { font-family:'Caveat',cursive; font-size:.82rem; font-weight:600; color:var(--pd); }
    .card-title { font-family:'Caveat',cursive; font-size:1.2rem; font-weight:700; color:var(--ink); margin:3px 0 5px; line-height:1.2; }
    .card-seller { font-size:.73rem; color:var(--pd); font-weight:600; }
    .card-desc { font-size:.76rem; color:var(--ch); line-height:1.55; margin-top:4px; }
    .washi { background:rgba(155,137,180,.28); color:var(--pk); font-family:'Caveat',cursive;
      font-size:.95rem; font-weight:700; padding:2px 12px;
      border-radius:3px 5px 4px 3px/5px 3px 5px 4px; transform:rotate(-1.5deg);
      display:inline-block; border:1px solid rgba(155,137,180,.4); }
    .stars { color:#c9a96e; font-size:.8rem; }

    /* ── Grid ── */
    #servicesGrid { columns:1; gap:18px; }
    @media(min-width:640px){#servicesGrid{columns:2}}
    @media(min-width:1024px){#servicesGrid{columns:3}}
    @media(min-width:1280px){#servicesGrid{columns:4}}

    /* ── Section wrapper ── */
    .content-wrap { max-width:1200px; margin:0 auto; padding:0 24px; }

    @keyframes reveal{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}

    /* ── Skeleton ── */
    .skel { background:linear-gradient(90deg,#e8e2f3 25%,#f0ecf8 50%,#e8e2f3 75%); background-size:200% 100%; animation:shim 1.5s infinite; border-radius:8px; }
    @keyframes shim { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

    /* ── Modal ── */
    .modal-overlay { position:fixed; inset:0; background:rgba(46,42,59,.55); z-index:200; display:flex; align-items:center; justify-content:center; padding:20px; backdrop-filter:blur(4px); }
    .modal-box { background:#fff; border:2px solid var(--ps); border-radius:16px 12px 18px 14px; max-width:560px; width:100%; padding:28px; position:relative; max-height:88vh; overflow-y:auto; }
    .modal-close { position:absolute; top:12px; right:16px; font-size:1.3rem; color:var(--pk); cursor:pointer; background:none; border:none; font-family:'Caveat',cursive; }

    /* ── Booking tabs ── */
    .tab-bar { display:flex; border-bottom:2px solid var(--pp); margin-bottom:24px; gap:0; }
    .tab-btn { padding:10px 24px; font-family:'Caveat',cursive; font-size:1.05rem; font-weight:700; color:var(--ch); border:none; background:none; cursor:pointer; border-bottom:3px solid transparent; margin-bottom:-2px; transition:.2s; }
    .tab-btn.active { color:var(--pk); border-bottom-color:var(--pk); }

    /* ── Booking card ── */
    .booking-card { background:#fff; border:2px solid #d8d0e8; border-radius:12px 8px 14px 10px; padding:16px 20px; margin-bottom:14px; display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
    .booking-info { flex:1; min-width:200px; }
    .booking-title { font-family:'Caveat',cursive; font-size:1.15rem; font-weight:700; color:var(--ink); }
    .booking-meta { font-size:.78rem; color:var(--ch); margin-top:3px; }
    .status-badge { font-family:'Caveat',cursive; font-size:.88rem; font-weight:700; padding:3px 12px; border-radius:999px; }
    .status-Pending   { background:#fef3c7; color:#d97706; }
    .status-Confirmed { background:#dbeafe; color:#2563eb; }
    .status-Completed { background:#d1fae5; color:#059669; }

    /* ── Transaction modal ── */
    .trans-row { display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px dashed var(--pp); font-size:.85rem; }
    .trans-row:last-child { border-bottom:none; }
    .trans-label { color:var(--ch); }
    .trans-value { font-weight:700; color:var(--ink); }

    /* ── Post Gig form ── */
    .form-group { margin-bottom:16px; }
    .form-label { font-family:'Caveat',cursive; font-size:1rem; font-weight:700; color:var(--pk); display:block; margin-bottom:6px; }
    .form-input, .form-select, .form-textarea {
      width:100%; border:2px solid var(--ps); border-radius:8px 5px 10px 6px/6px 10px 5px 8px;
      padding:10px 14px; font-family:'Nunito',sans-serif; font-size:.87rem; color:var(--ink);
      background:#fff; outline:none; transition:border-color .2s; }
    .form-input:focus,.form-select:focus,.form-textarea:focus { border-color:var(--pk); }
    .form-textarea { resize:vertical; min-height:90px; }

    /* ── How it works ── */
    .how-step { background:#fff; border:2px solid #d8d0e8; border-radius:14px 10px 16px 11px; padding:24px; text-align:center; }
    .how-icon { font-size:2.5rem; margin-bottom:12px; }
    .how-title { font-family:'Caveat',cursive; font-size:1.3rem; font-weight:700; color:var(--ink); margin-bottom:8px; }
    .how-desc { font-size:.83rem; color:var(--ch); line-height:1.6; }
    .flow-arrow { color:var(--ps); font-size:1.8rem; display:flex; align-items:center; justify-content:center; padding-top:20px; }

    /* ── Star rating input ── */
    .star-rating { display:flex; gap:6px; font-size:1.6rem; cursor:pointer; }
    .star-rating span { color:#ddd; transition:.15s; }
    .star-rating span.on { color:#c9a96e; }

    /* ── Toast ── */
    #toast { position:fixed; bottom:28px; right:28px; background:var(--pk); color:#fff;
      font-family:'Caveat',cursive; font-size:1.05rem; padding:12px 22px;
      border-radius:10px 7px 12px 8px; box-shadow:4px 4px 0 rgba(0,0,0,.15);
      z-index:999; transform:translateY(80px); opacity:0; transition:.35s; pointer-events:none; }
    #toast.show { transform:translateY(0); opacity:1; }

    /* ── Footer ── */
    .footer-doodle { height:4px; background:repeating-linear-gradient(90deg,var(--ps) 0,var(--ps) 10px,transparent 10px,transparent 18px); }
  </style>
</head>
<body>

<!-- ══════════ NAVBAR ══════════ -->
<nav class="navbar">
  <a class="logo" href="#" onclick="showPage('home')">Campus<span>Gigs</span>
    <span style="font-size:.7rem;background:var(--pp);color:var(--pk);border:1.5px solid var(--ps);border-radius:999px;padding:1px 8px;font-family:'Caveat',cursive;vertical-align:middle;margin-left:6px;">✦ IoBM</span>
  </a>
  <div class="nav-links">
    <button class="nav-link active" id="nav-home"     onclick="showPage('home')">Find Services</button>
    <button class="nav-link"        id="nav-bookings" onclick="showPage('bookings')">My Bookings</button>
    <button class="nav-link"        id="nav-how"      onclick="showPage('how')">How It Works</button>
  </div>
  <div class="nav-actions">
    <button class="btn btn-primary" onclick="openPostGig()">✦ Post a Gig</button>
  </div>
</nav>

<!-- ══════════ PAGE: HOME ══════════ -->
<div class="page active" id="page-home">

  <!-- Hero -->
  <section class="hero">
    <div class="sparkle" style="top:15%;left:5%;font-size:22px;animation-delay:.2s">✦</div>
    <div class="sparkle" style="top:55%;left:7%;font-size:16px;animation-delay:1.2s">✶</div>
    <div class="sparkle" style="top:20%;right:6%;font-size:24px;animation-delay:.6s">✦</div>
    <div class="sparkle" style="top:65%;right:5%;font-size:18px;animation-delay:1.8s">★</div>
    <div class="sparkle" style="top:40%;left:12%;font-size:14px;animation-delay:2.2s">✦</div>
    <p style="font-family:'Caveat',cursive;font-size:1rem;font-weight:600;color:var(--pd);letter-spacing:2px;margin-bottom:10px;">✦ IoBM's student service marketplace ✦</p>
    <h1 class="hero-title">Find campus talent,<br/>make things happen 🌸</h1>
    <p class="hero-sub">Browse gigs from fellow students — from code to creative, all in one cozy place.</p>
    <div class="search-wrap">
      <svg style="margin-left:14px;color:#b0a8c0;flex-shrink:0" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      <input id="searchInput" type="text" placeholder="Search services… e.g. 'Python help', 'logo design'" onkeydown="if(event.key==='Enter')doSearch()"/>
      <button class="btn btn-primary" style="margin:6px;padding:9px 20px;font-size:1rem;" onclick="doSearch()">Search ✦</button>
    </div>
    <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:8px;">
      <span style="font-family:'Caveat',cursive;font-size:.9rem;color:var(--pd);font-weight:600;line-height:2;">trending:</span>
      <button onclick="quickSearch('Python')"       style="background:rgba(255,255,255,.6);color:var(--pk);font-size:.75rem;font-weight:600;padding:4px 14px;border-radius:999px;border:1.5px solid var(--ps);cursor:pointer;">Python</button>
      <button onclick="quickSearch('Logo')"         style="background:rgba(255,255,255,.6);color:var(--pk);font-size:.75rem;font-weight:600;padding:4px 14px;border-radius:999px;border:1.5px solid var(--ps);cursor:pointer;">Logo Design</button>
      <button onclick="quickSearch('Proofreading')" style="background:rgba(255,255,255,.6);color:var(--pk);font-size:.75rem;font-weight:600;padding:4px 14px;border-radius:999px;border:1.5px solid var(--ps);cursor:pointer;">Proofreading</button>
      <button onclick="quickSearch('SQL')"          style="background:rgba(255,255,255,.6);color:var(--pk);font-size:.75rem;font-weight:600;padding:4px 14px;border-radius:999px;border:1.5px solid var(--ps);cursor:pointer;">SQL Help</button>
    </div>
  </section>

  <!-- Category Filter -->
  <div class="content-wrap" style="padding-top:28px;padding-bottom:12px;display:flex;flex-wrap:wrap;gap:10px;">
    <button class="cat-pill active" onclick="filterCat(this,'')" data-cat="">
      <span class="icon" style="background:var(--pp);">🗂️</span> All Services
    </button>
    <button class="cat-pill" onclick="filterCat(this,'Tech & Code')" data-cat="Tech & Code">
      <span class="icon" style="background:#dff0ff;">💻</span> Tech &amp; Code
    </button>
    <button class="cat-pill" onclick="filterCat(this,'Academics')" data-cat="Academics">
      <span class="icon" style="background:#fffde7;">📚</span> Academics
    </button>
    <button class="cat-pill" onclick="filterCat(this,'Creative')" data-cat="Creative">
      <span class="icon" style="background:#fce4ec;">🎨</span> Creative
    </button>
    <button class="cat-pill" onclick="filterCat(this,'Business')" data-cat="Business">
      <span class="icon" style="background:#e8f5e9;">📊</span> Business
    </button>
  </div>

  <!-- Grid -->
  <main class="content-wrap" style="padding-bottom:60px;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
      <p id="serviceCount" style="font-family:'Caveat',cursive;font-size:1.15rem;color:var(--ch);font-weight:600;">✦ Loading…</p>
      <select id="sortSel" onchange="renderGrid()" style="font-size:.8rem;border:2px solid var(--ps);border-radius:8px;padding:7px 12px;background:#fff;color:var(--ch);outline:none;cursor:pointer;">
        <option value="newest">Newest First</option>
        <option value="price_asc">Price: Low → High</option>
        <option value="price_desc">Price: High → Low</option>
        <option value="rating">Top Rated</option>
      </select>
    </div>
    <div id="servicesGrid">
      <div class="skel" style="height:260px;margin-bottom:18px;"></div>
      <div class="skel" style="height:220px;margin-bottom:18px;"></div>
      <div class="skel" style="height:290px;margin-bottom:18px;"></div>
    </div>
    <div style="text-align:center;margin-top:32px;">
      <button class="btn btn-primary" style="font-size:1.1rem;padding:10px 32px;" onclick="loadMore()">✦ Load More Gigs</button>
    </div>
  </main>
</div>

<!-- ══════════ PAGE: MY BOOKINGS ══════════ -->
<div class="page" id="page-bookings">
  <div class="content-wrap" style="padding-top:36px;padding-bottom:60px;">
    <h1 style="font-family:'Caveat',cursive;font-size:2rem;font-weight:700;color:var(--ink);margin-bottom:6px;">My Bookings 📋</h1>
    <p style="font-size:.85rem;color:var(--ch);margin-bottom:24px;">Welcome back, <strong style="color:var(--pk);" id="currentUserName">Loading...</strong></p>

    <div class="tab-bar">
      <button class="tab-btn active" id="tab-orders"  onclick="switchTab('orders')">Gigs I've Ordered</button>
      <button class="tab-btn"        id="tab-gigs"    onclick="switchTab('gigs')">My Gigs (as Seller)</button>
      <button class="tab-btn"        id="tab-review"  onclick="switchTab('review')">Pending Review</button>
    </div>

    <div id="bookingsList">
      <div class="skel" style="height:80px;margin-bottom:12px;border-radius:12px;"></div>
      <div class="skel" style="height:80px;margin-bottom:12px;border-radius:12px;"></div>
    </div>
  </div>
</div>

<!-- ══════════ PAGE: HOW IT WORKS ══════════ -->
<div class="page" id="page-how">
  <div class="content-wrap" style="padding-top:48px;padding-bottom:60px;">
    <div style="text-align:center;margin-bottom:40px;">
      <p style="font-family:'Caveat',cursive;font-size:1rem;color:var(--pd);letter-spacing:2px;margin-bottom:8px;">✦ simple as 1-2-3 ✦</p>
      <h1 style="font-family:'Caveat',cursive;font-size:2.4rem;font-weight:700;color:var(--ink);">How Campus Gigs Works</h1>
      <p style="font-size:.9rem;color:var(--ch);margin-top:8px;max-width:500px;margin-left:auto;margin-right:auto;">A student-built service marketplace for IoBM — sell your skills or hire your classmates.</p>
    </div>

    <!-- For Buyers -->
    <h2 style="font-family:'Caveat',cursive;font-size:1.5rem;color:var(--pk);margin-bottom:20px;">🛒 If you want to hire someone</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:40px;">
      <div class="how-step">
        <div class="how-icon">🔍</div>
        <div class="how-title">1. Browse Services</div>
        <div class="how-desc">Search or filter gigs by category. Each card shows the price, seller, and rating from real reviews.</div>
      </div>
      <div class="how-step">
        <div class="how-icon">📋</div>
        <div class="how-title">2. View Details</div>
        <div class="how-desc">Click any gig to read the full description, see all reviews left by previous buyers, and check the seller's profile.</div>
      </div>
      <div class="how-step">
        <div class="how-icon">💳</div>
        <div class="how-title">3. Book the Gig</div>
        <div class="how-desc">Click "Book This Gig" — a transaction summary appears showing the service, seller, and price. Confirm to place the order.</div>
      </div>
      <div class="how-step">
        <div class="how-icon">⭐</div>
        <div class="how-title">4. Leave a Review</div>
        <div class="how-desc">Once the seller marks your order Completed, go to My Bookings → Gigs I've Ordered and leave a star rating + comment.</div>
      </div>
    </div>

    <!-- For Sellers -->
    <h2 style="font-family:'Caveat',cursive;font-size:1.5rem;color:var(--pk);margin-bottom:20px;">💼 If you want to earn</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:48px;">
      <div class="how-step">
        <div class="how-icon">✍️</div>
        <div class="how-title">1. Post a Gig</div>
        <div class="how-desc">Click "Post a Gig" in the top right. Fill in your title, category, description, price, and an image URL. It saves to the database instantly.</div>
      </div>
      <div class="how-step">
        <div class="how-icon">🔔</div>
        <div class="how-title">2. Get Orders</div>
        <div class="how-desc">When a buyer books your gig, it appears in My Bookings → My Gigs tab with a Pending status.</div>
      </div>
      <div class="how-step">
        <div class="how-icon">✅</div>
        <div class="how-title">3. Update Status</div>
        <div class="how-desc">Change the booking status to Confirmed when you start, then Completed when done. The buyer can then leave a review.</div>
      </div>
      <div class="how-step">
        <div class="how-icon">💰</div>
        <div class="how-title">4. Build your rep</div>
        <div class="how-desc">Good reviews raise your average rating shown on the card. Higher ratings = more bookings.</div>
      </div>
    </div>

    <div style="background:var(--pp);border:2px dashed var(--ps);border-radius:14px;padding:28px;margin-bottom:32px;text-align:center;">
      <p style="font-family:'Caveat',cursive;font-size:1.5rem;font-weight:700;color:var(--pk);margin-bottom:8px;">Every action is saved in real time</p>
      <p style="font-size:.85rem;color:var(--ch);line-height:1.8;max-width:560px;margin:0 auto;">Whether you book a gig, post a listing, update a status, or leave a review — it reflects instantly in the database and on every screen.</p>
    </div>

    <div style="text-align:center;">
      <button class="btn btn-primary" style="font-size:1.15rem;padding:12px 36px;" onclick="showPage('home')">✦ Start Browsing Gigs</button>
    </div>
  </div>
</div>

<!-- ══════════ MODAL: SERVICE DETAIL ══════════ -->
<div class="modal-overlay" id="modalDetail" style="display:none" onclick="closeOnOverlay(event,'modalDetail')">
  <div class="modal-box" style="max-width:600px;">
    <button class="modal-close" onclick="closeModal('modalDetail')">✕</button>
    <div id="modalDetailContent"></div>
  </div>
</div>

<!-- ══════════ MODAL: TRANSACTION / BOOK GIG ══════════ -->
<div class="modal-overlay" id="modalTrans" style="display:none" onclick="closeOnOverlay(event,'modalTrans')">
  <div class="modal-box" style="max-width:440px;">
    <button class="modal-close" onclick="closeModal('modalTrans')">✕</button>
    <h2 style="font-family:'Caveat',cursive;font-size:1.6rem;font-weight:700;color:var(--ink);margin-bottom:4px;">Confirm Booking 💳</h2>
    <p style="font-size:.8rem;color:var(--ch);margin-bottom:20px;">Review your order before confirming</p>
    <div id="transDetails"></div>
    <div style="display:flex;gap:10px;margin-top:20px;">
      <button class="btn btn-outline" style="flex:1" onclick="closeModal('modalTrans')">Cancel</button>
      <button class="btn btn-primary" style="flex:2;font-size:1.1rem;" id="confirmBookBtn">✦ Confirm &amp; Book</button>
    </div>
  </div>
</div>

<!-- ══════════ MODAL: POST A GIG ══════════ -->
<div class="modal-overlay" id="modalPost" style="display:none" onclick="closeOnOverlay(event,'modalPost')">
  <div class="modal-box" style="max-width:500px;">
    <button class="modal-close" onclick="closeModal('modalPost')">✕</button>
    <h2 style="font-family:'Caveat',cursive;font-size:1.7rem;font-weight:700;color:var(--ink);margin-bottom:4px;">Post a New Gig ✍️</h2>
    <p style="font-size:.8rem;color:var(--ch);margin-bottom:20px;">Fill in the details — it saves directly to the database</p>

    <div class="form-group">
      <label class="form-label">Your Name (Seller)</label>
      <input class="form-input" id="postSellerName" type="text" placeholder="e.g. Ayesha Khalid"/>
    </div>
    <div class="form-group">
      <label class="form-label">Category</label>
      <select class="form-select" id="postCategory"></select>
    </div>
    <div class="form-group">
      <label class="form-label">Gig Title</label>
      <input class="form-input" id="postTitle" type="text" placeholder="e.g. I will fix your Python assignment"/>
    </div>
    <div class="form-group">
      <label class="form-label">Description</label>
      <textarea class="form-textarea" id="postDesc" placeholder="Describe what you offer, what's included, delivery time…"></textarea>
    </div>
    <div class="form-group">
      <label class="form-label">Price (Rs)</label>
      <input class="form-input" id="postPrice" type="number" min="1" placeholder="e.g. 800"/>
    </div>
    <div class="form-group">
      <label class="form-label">Image URL <span style="font-size:.78rem;font-family:'Nunito',sans-serif;font-weight:400;color:var(--ch);">(paste any image link — optional)</span></label>
      <input class="form-input" id="postImage" type="url" placeholder="https://images.unsplash.com/…"/>
    </div>
    <button class="btn btn-primary" style="width:100%;font-size:1.1rem;padding:11px;" onclick="submitGig()">✦ Publish Gig to Database</button>
    <p id="postMsg" style="margin-top:10px;font-size:.82rem;text-align:center;color:var(--pk);display:none;"></p>
  </div>
</div>

<!-- ══════════ MODAL: PAYMENT SUCCESS ══════════ -->
<div class="modal-overlay" id="modalPayment" style="display:none" onclick="closeOnOverlay(event,'modalPayment')">
  <div class="modal-box" style="max-width:420px;">
    <button class="modal-close" onclick="closeModal('modalPayment');loadBookings()">✕</button>
    <div id="paymentDetails"></div>
    <button class="btn btn-primary" style="width:100%;font-size:1.05rem;padding:10px;margin-top:8px;" onclick="closeModal('modalPayment');showPage('bookings')">View My Bookings</button>
  </div>
</div>

<!-- ══════════ MODAL: LEAVE REVIEW ══════════ -->
<div class="modal-overlay" id="modalReview" style="display:none" onclick="closeOnOverlay(event,'modalReview')">
  <div class="modal-box" style="max-width:420px;">
    <button class="modal-close" onclick="closeModal('modalReview')">✕</button>
    <h2 style="font-family:'Caveat',cursive;font-size:1.6rem;font-weight:700;color:var(--ink);margin-bottom:4px;">Leave a Review ⭐</h2>
    <p style="font-size:.8rem;color:var(--ch);margin-bottom:18px;" id="reviewServiceName"></p>
    <div class="form-group">
      <label class="form-label">Rating</label>
      <div class="star-rating" id="starInput">
        <span data-v="1">★</span><span data-v="2">★</span><span data-v="3">★</span><span data-v="4">★</span><span data-v="5">★</span>
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Comment</label>
      <textarea class="form-textarea" id="reviewComment" placeholder="Share your experience…"></textarea>
    </div>
    <input type="hidden" id="reviewBookingId"/>
    <button class="btn btn-primary" style="width:100%;font-size:1.05rem;padding:10px;" onclick="submitReview()">✦ Submit Review</button>
  </div>
</div>

<!-- ══════════ TOAST ══════════ -->
<div id="toast"></div>

<!-- ══════════ FOOTER ══════════ -->
<div class="footer-doodle"></div>
<footer style="background:var(--pp);border-top:2px dashed var(--ps);padding:20px 24px;text-align:center;">
  <p style="font-family:'Caveat',cursive;font-size:1.05rem;color:var(--pk);font-weight:600;">✦ made with love at IoBM, Karachi ✦</p>
</footer>

<!-- ══════════ JAVASCRIPT ══════════ ══════════ ══════════ -->
<script>
// ── State ─────────────────────────────────────────────────────
const DEMO_USER_ID = 6; // Zain Ahmed (Student) — in a real app from login session
let allServices  = [];
let visibleCount = 12;
let activeCategory = '';
let activeSearch    = '';
let selectedRating  = 0;
let pendingBooking  = null; // {service_id, title, price, seller}
let categories      = [];
let sellers         = [];
let activeBookingTab = 'orders';

const catIcon = {'Tech & Code':'💻','Academics':'📚','Creative':'🎨','Business':'📊'};
const fallbackImgs = {
  'Tech & Code':'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=400&q=80',
  'Academics':'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=400&q=80',
  'Creative':'https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=400&q=80',
  'Business':'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=400&q=80',
};

// ── Page navigation ───────────────────────────────────────────
function showPage(name) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-link').forEach(b => b.classList.remove('active'));
  document.getElementById('page-' + name).classList.add('active');
  document.getElementById('nav-' + name)?.classList.add('active');
  if (name === 'bookings') loadBookings();
  window.scrollTo(0,0);
}

// ── Toast ─────────────────────────────────────────────────────
function toast(msg) {
  const t = document.getElementById('toast');
  t.textContent = msg; t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3000);
}

// ── Modals ────────────────────────────────────────────────────
function closeModal(id) { document.getElementById(id).style.display='none'; }
function closeOnOverlay(e, id) { if(e.target.id===id) closeModal(id); }

// ── Stars renderer ────────────────────────────────────────────
function starsHTML(r) {
  const f = Math.round(r);
  return '<span class="stars">'+'★'.repeat(f)+'☆'.repeat(5-f)+'</span>';
}

// ── Fetch & render services ───────────────────────────────────
async function fetchServices() {
  try {
    let url = `get_services.php?category=${encodeURIComponent(activeCategory)}&search=${encodeURIComponent(activeSearch)}`;
    const res = await fetch(url);
    allServices = await res.json();
    if (allServices.error) throw new Error(allServices.error);
    visibleCount = 12;
    renderGrid();
  } catch(e) {
    document.getElementById('servicesGrid').innerHTML =
      `<p style="font-family:'Caveat',cursive;font-size:1.2rem;color:var(--pd);text-align:center;padding:40px;grid-column:1/-1;">
        ⚠️ Could not reach the database.<br>
        <span style="font-size:.85rem;font-family:'Nunito',sans-serif;color:var(--ch);">Make sure XAMPP Apache &amp; MySQL are both running.</span>
      </p>`;
    document.getElementById('serviceCount').textContent = '⚠️ Connection error';
  }
}

function getSorted() {
  const s = [...allServices];
  const v = document.getElementById('sortSel').value;
  if (v==='price_asc')  return s.sort((a,b)=>a.price-b.price);
  if (v==='price_desc') return s.sort((a,b)=>b.price-a.price);
  if (v==='rating')     return s.sort((a,b)=>b.avg_rating-a.avg_rating);
  return s; // newest = default DB order DESC
}

function renderGrid() {
  const sorted  = getSorted();
  const visible = sorted.slice(0, visibleCount);
  const grid    = document.getElementById('servicesGrid');
  document.getElementById('serviceCount').textContent = allServices.length + ' service' + (allServices.length!==1?'s':'') + ' found';

  if (!visible.length) {
    grid.innerHTML = `<p style="font-family:'Caveat',cursive;font-size:1.3rem;color:var(--pd);text-align:center;padding:60px;">No services found! Try a different search.</p>`;
    return;
  }

  grid.innerHTML = visible.map((s,i) => {
    const img = s.image_url && s.image_url.trim()
      ? s.image_url
      : (fallbackImgs[s.category_name] || 'https://images.unsplash.com/photo-1434030216411-0b793f4b6f74?w=400&q=80');
    return `
    <div class="service-card" style="animation:reveal .45s ease ${i*.04}s both;" onclick="openDetail(${s.service_id})">
      <img class="card-img" src="${img}" alt="${s.title}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'"/>
      <div class="card-img-placeholder" style="display:none;">${catIcon[s.category_name]||'?'}</div>
      <div class="card-body">
        <span class="cat-label">${catIcon[s.category_name]||''} ${s.category_name}</span>
        <h3 class="card-title">${s.title}</h3>
        <p class="card-seller">by ${s.seller_name}</p>
        <p class="card-desc">${s.description.substring(0,90)}${s.description.length>90?'...':''}</p>
        ${s.review_count>0?`<div style="display:flex;align-items:center;gap:5px;margin-top:6px;">${starsHTML(s.avg_rating)}<span style="font-size:.72rem;color:var(--ch);">${s.avg_rating} (${s.review_count})</span></div>`:''}
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px;flex-wrap:wrap;gap:8px;">
          <span class="washi">Rs ${Number(s.price).toLocaleString()}</span>
          <button class="btn btn-outline" onclick="event.stopPropagation();openDetail(${s.service_id})">View Details &rarr;</button>
        </div>
      </div>
    </div>`;
  }).join('');
}

function loadMore() { visibleCount += 8; renderGrid(); }

function filterCat(btn, cat) {
  document.querySelectorAll('.cat-pill').forEach(p=>p.classList.remove('active'));
  btn.classList.add('active');
  activeCategory = cat;
  fetchServices();
}
function doSearch() { activeSearch = document.getElementById('searchInput').value.trim(); fetchServices(); }
function quickSearch(q) { document.getElementById('searchInput').value=q; activeSearch=q; fetchServices(); }

// ── Service Detail Modal ──────────────────────────────────────
async function openDetail(serviceId) {
  document.getElementById('modalDetail').style.display='flex';
  document.getElementById('modalDetailContent').innerHTML=
    `<div class="skel" style="height:220px;border-radius:10px;margin-bottom:16px;"></div><div class="skel" style="height:80px;border-radius:8px;"></div>`;

  const [sRes, rRes] = await Promise.all([
    fetch('get_services.php'),
    fetch(`get_reviews.php?service_id=${serviceId}`)
  ]);
  const services = await sRes.json();
  const reviews  = await rRes.json();
  const s = services.find(x=>x.service_id==serviceId);
  if (!s) { document.getElementById('modalDetailContent').innerHTML='<p>Not found.</p>'; return; }

  const img = s.image_url && s.image_url.trim()
    ? s.image_url
    : (fallbackImgs[s.category_name]||'');

  const reviewsHTML = reviews.length
    ? reviews.map(r=>`
        <div style="border:1.5px dashed var(--ps);border-radius:8px;padding:10px 14px;margin-bottom:10px;">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
            ${starsHTML(r.rating)}
            <span style="font-family:'Caveat',cursive;font-size:.95rem;color:var(--pk);font-weight:600;">${r.reviewer_name}</span>
          </div>
          <p style="font-size:.8rem;color:var(--ch);line-height:1.5;">${r.comment||'No comment.'}</p>
        </div>`).join('')
    : `<p style="font-size:.82rem;color:var(--ch);font-style:italic;">No reviews yet — be the first to book!</p>`;

  document.getElementById('modalDetailContent').innerHTML=`
    ${img?`<img src="${img}" style="width:100%;height:200px;object-fit:cover;border-radius:10px;margin-bottom:16px;" onerror="this.style.display='none'"/>`:''}
    <span class="cat-label" style="display:block;margin-bottom:4px;">${catIcon[s.category_name]||'📁'} ${s.category_name}</span>
    <h2 style="font-family:'Caveat',cursive;font-size:1.7rem;font-weight:700;color:var(--ink);margin-bottom:4px;">${s.title}</h2>
    <p style="font-size:.78rem;color:var(--pd);font-weight:600;margin-bottom:10px;">by ${s.seller_name} · ${s.booking_count} order${s.booking_count!=1?'s':''}</p>
    <p style="font-size:.86rem;color:var(--ch);line-height:1.75;margin-bottom:16px;">${s.description}</p>
    <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;flex-wrap:wrap;">
      <span class="washi" style="font-size:1.1rem;">Rs ${Number(s.price).toLocaleString()}</span>
      ${s.review_count>0?`${starsHTML(s.avg_rating)}<span style="font-size:.78rem;color:var(--ch);">${s.avg_rating} (${s.review_count} review${s.review_count!=1?'s':''})</span>`:''}
    </div>
    <button class="btn btn-primary" style="width:100%;font-size:1.1rem;padding:12px;margin-bottom:20px;"
      onclick="openTransaction(${s.service_id},'${s.title.replace(/'/g,"\\'")}',${s.price},'${s.seller_name.replace(/'/g,"\\'")}')">
      💳 Book This Gig
    </button>
    <h3 style="font-family:'Caveat',cursive;font-size:1.2rem;font-weight:700;color:var(--ink);margin-bottom:12px;">Reviews</h3>
    ${reviewsHTML}
  `;
}

// ── Transaction Modal ─────────────────────────────────────────
function openTransaction(serviceId, title, price, seller) {
  pendingBooking = {serviceId, title, price, seller};
  closeModal('modalDetail');

  const fee      = Math.round(price * 0.05);
  const total    = Number(price) + fee;

  document.getElementById('transDetails').innerHTML=`
    <div style="background:var(--pp);border-radius:10px;padding:16px;margin-bottom:16px;">
      <p style="font-family:'Caveat',cursive;font-size:1.1rem;font-weight:700;color:var(--ink);margin-bottom:4px;">${title}</p>
      <p style="font-size:.78rem;color:var(--pd);">Seller: ${seller}</p>
    </div>
    <div class="trans-row"><span class="trans-label">Service Price</span><span class="trans-value">Rs ${Number(price).toLocaleString()}</span></div>
    <div class="trans-row"><span class="trans-label">Platform Fee (5%)</span><span class="trans-value">Rs ${fee.toLocaleString()}</span></div>
    <div class="trans-row" style="border-bottom:2px solid var(--ps)!important;">
      <span style="font-family:'Caveat',cursive;font-size:1.05rem;font-weight:700;color:var(--ink);">Total</span>
      <span style="font-family:'Caveat',cursive;font-size:1.2rem;font-weight:700;color:var(--pk);">Rs ${total.toLocaleString()}</span>
    </div>
    <p style="font-size:.75rem;color:var(--ch);margin-top:10px;text-align:center;">Booking will be saved to the database with status: <strong>Pending</strong></p>
  `;

  document.getElementById('confirmBookBtn').onclick = confirmBooking;
  document.getElementById('modalTrans').style.display='flex';
}

async function confirmBooking() {
  if (!pendingBooking) return;
  document.getElementById('confirmBookBtn').textContent='Processing...';
  document.getElementById('confirmBookBtn').disabled=true;

  try {
    const res  = await fetch('get_bookings.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({buyer_id: DEMO_USER_ID, service_id: pendingBooking.serviceId})
    });
    const data = await res.json();
    if (data.success) {
      closeModal('modalTrans');
      // Show payment success popup
      const fee   = Math.round(pendingBooking.price * 0.05);
      const total = Number(pendingBooking.price) + fee;
      document.getElementById('paymentDetails').innerHTML = `
        <div style="text-align:center;margin-bottom:20px;">
          <div style="font-size:3rem;margin-bottom:8px;">✅</div>
          <h2 style="font-family:'Caveat',cursive;font-size:1.8rem;font-weight:700;color:var(--ink);margin-bottom:4px;">Payment Successful!</h2>
          <p style="font-size:.82rem;color:var(--ch);">Order #${data.booking_id} confirmed</p>
        </div>
        <div style="background:var(--pp);border-radius:12px;padding:16px;margin-bottom:16px;">
          <p style="font-family:'Caveat',cursive;font-size:1.1rem;font-weight:700;color:var(--ink);margin-bottom:4px;">${pendingBooking.title}</p>
          <p style="font-size:.78rem;color:var(--pd);">Seller: ${pendingBooking.seller}</p>
        </div>
        <div class="trans-row"><span class="trans-label">Amount Paid</span><span class="trans-value" style="color:#059669;">Rs ${total.toLocaleString()}</span></div>
        <div class="trans-row"><span class="trans-label">Status</span><span style="background:#fef3c7;color:#d97706;font-family:'Caveat',cursive;font-size:.9rem;font-weight:700;padding:2px 10px;border-radius:999px;">Pending</span></div>
        <div class="trans-row"><span class="trans-label">Date</span><span class="trans-value">${new Date().toLocaleDateString('en-PK',{day:'numeric',month:'long',year:'numeric'})}</span></div>
        <p style="font-size:.75rem;color:var(--ch);text-align:center;margin-top:14px;">Your booking is now visible in My Bookings. The seller will confirm shortly.</p>
      `;
      document.getElementById('modalPayment').style.display='flex';
      pendingBooking = null;
      fetchServices();
    } else {
      toast('Error: '+(data.error||'Something went wrong'));
    }
  } catch(e) { toast('Network error — is XAMPP running?'); }

  document.getElementById('confirmBookBtn').textContent='✦ Confirm & Book';
  document.getElementById('confirmBookBtn').disabled=false;
}

// ── Post a Gig ────────────────────────────────────────────────
async function openPostGig() {
  document.getElementById('modalPost').style.display='flex';
  document.getElementById('postMsg').style.display='none';
  document.getElementById('postSellerName').value='';

  // Load categories
  if (!categories.length) {
    const res = await fetch('get_categories.php');
    categories = await res.json();
  }
  const catSel = document.getElementById('postCategory');
  catSel.innerHTML = categories.map(c=>`<option value="${c.category_id}">${c.category_name}</option>`).join('');
}

async function submitGig() {
  const seller_name = document.getElementById('postSellerName').value.trim();
  const category_id = document.getElementById('postCategory').value;
  const title       = document.getElementById('postTitle').value.trim();
  const description = document.getElementById('postDesc').value.trim();
  const price       = document.getElementById('postPrice').value;
  const image_url   = document.getElementById('postImage').value.trim();
  const msg         = document.getElementById('postMsg');

  if (!seller_name || !title || !description || !price) {
    msg.style.display='block'; msg.style.color='#dc2626';
    msg.textContent='Please fill in all required fields.'; return;
  }

  msg.style.display='block'; msg.style.color='var(--pd)'; msg.textContent='Saving to database...';

  try {
    const res  = await fetch('get_services.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({seller_name, category_id, title, description, price, image_url})
    });
    const data = await res.json();
    if (data.success) {
      closeModal('modalPost');
      toast('Gig posted! It is now live.');
      ['postSellerName','postTitle','postDesc','postPrice','postImage'].forEach(id=>document.getElementById(id).value='');
      fetchServices();
    } else {
      msg.style.color='#dc2626'; msg.textContent='Error: '+(data.error||'Failed to save.');
    }
  } catch(e) { msg.style.color='#dc2626'; msg.textContent='Network error.'; }
}

// ── My Bookings ───────────────────────────────────────────────
function switchTab(tab) {
  activeBookingTab = tab;
  document.getElementById('tab-orders').classList.toggle('active', tab==='orders');
  document.getElementById('tab-gigs').classList.toggle('active',   tab==='gigs');
  document.getElementById('tab-review').classList.toggle('active', tab==='review');
  loadBookings();
}

async function loadBookings() {
  document.getElementById('currentUserName').textContent = 'Zain Ahmed';
  document.getElementById('bookingsList').innerHTML =
    '<div class="skel" style="height:80px;margin-bottom:12px;border-radius:12px;"></div>' +
    '<div class="skel" style="height:80px;margin-bottom:12px;border-radius:12px;"></div>';

  try {
    // ── Pending Review tab ───────────────────────────────────
    if (activeBookingTab === 'review') {
      const res      = await fetch('get_bookings.php?type=my_orders&user_id='+DEMO_USER_ID);
      const bookings = await res.json();
      const pending  = bookings.filter(b => b.status === 'Completed' && !b.review_id);

      if (!pending.length) {
        document.getElementById('bookingsList').innerHTML =
          '<div style="text-align:center;padding:60px;font-family:\'Caveat\',cursive;font-size:1.3rem;color:var(--pd);">No gigs pending review yet!<br><span style="font-size:.9rem;font-family:\'Nunito\',sans-serif;color:var(--ch);">Completed bookings will appear here.</span></div>';
        return;
      }

      document.getElementById('bookingsList').innerHTML = pending.map(b =>
        '<div class="booking-card" style="border-color:var(--ps);">' +
          '<div style="width:44px;height:44px;border-radius:50%;background:var(--pp);display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;">' +
            (catIcon[b.category_name]||'?') +
          '</div>' +
          '<div class="booking-info">' +
            '<div class="booking-title">' + b.service_title + '</div>' +
            '<div class="booking-meta">Seller: ' + b.seller_name + ' · Rs ' + Number(b.price).toLocaleString() + ' · ' + b.booking_date + '</div>' +
          '</div>' +
          '<div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;">' +
            '<span class="status-badge status-Completed">Completed</span>' +
            '<button class="btn-danger" style="background:var(--pp);color:var(--pk);border-color:var(--ps);cursor:pointer;" onclick="openReview(' + b.booking_id + ',\'' + b.service_title.replace(/'/g,"\\'") + '\')">Leave Review</button>' +
          '</div>' +
        '</div>'
      ).join('');
      return;
    }

    // ── Orders / Gigs tabs ───────────────────────────────────
    const type     = activeBookingTab === 'gigs' ? 'my_gigs' : 'my_orders';
    const res      = await fetch('get_bookings.php?type='+type+'&user_id='+DEMO_USER_ID);
    const bookings = await res.json();

    if (!bookings.length) {
      document.getElementById('bookingsList').innerHTML =
        '<div style="text-align:center;padding:60px;font-family:\'Caveat\',cursive;font-size:1.3rem;color:var(--pd);">No bookings here yet!</div>';
      return;
    }

    document.getElementById('bookingsList').innerHTML = bookings.map(b => {
      const isSeller = activeBookingTab === 'gigs';
      const other    = isSeller ? 'Buyer: '+b.buyer_name : 'Seller: '+b.seller_name;

      let statusControls = '';
      if (isSeller) {
        statusControls = '<div style="display:flex;gap:6px;flex-wrap:wrap;margin-top:8px;">' +
          (b.status!=='Confirmed' && b.status!=='Completed' ? '<button class="btn-danger" style="background:#fffde7;color:#d97706;border-color:#fde68a;cursor:pointer;" onclick="updateStatus('+b.booking_id+',\'Confirmed\')">Mark Confirmed</button>' : '') +
          (b.status==='Confirmed' ? '<button class="btn-danger" style="background:#d1fae5;color:#059669;border-color:#6ee7b7;cursor:pointer;" onclick="updateStatus('+b.booking_id+',\'Completed\')">Mark Completed</button>' : '') +
        '</div>';
      }

      // 8. Only show "Reviewed" badge if completed AND reviewed. Never show on Pending.
      let reviewBadge = '';
      if (!isSeller && b.status === 'Completed' && b.review_id) {
        reviewBadge = '<span style="font-size:.75rem;color:#059669;font-weight:600;">Reviewed ' + starsHTML(b.rating) + '</span>';
      }

      return '<div class="booking-card">' +
        '<div style="width:44px;height:44px;border-radius:50%;background:var(--pp);display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;">' + (catIcon[b.category_name]||'?') + '</div>' +
        '<div class="booking-info">' +
          '<div class="booking-title">' + b.service_title + '</div>' +
          '<div class="booking-meta">' + other + ' · Rs ' + Number(b.price).toLocaleString() + ' · ' + b.booking_date + '</div>' +
          statusControls +
        '</div>' +
        '<div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;">' +
          '<span class="status-badge status-'+b.status+'">'+b.status+'</span>' +
          '<span style="font-size:.72rem;color:var(--ch);">#'+b.booking_id+'</span>' +
          reviewBadge +
        '</div>' +
      '</div>';
    }).join('');

  } catch(e) {
    document.getElementById('bookingsList').innerHTML =
      '<p style="font-family:\'Caveat\',cursive;color:var(--pd);font-size:1.1rem;text-align:center;padding:40px;">Could not load bookings — check XAMPP.</p>';
  }
}

async function updateStatus(bookingId, status) {
  try {
    const res  = await fetch('get_bookings.php', {
      method:'PATCH', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({booking_id: bookingId, status})
    });
    const data = await res.json();
    if (data.success) { toast(`✦ Status updated to ${status} in database`); loadBookings(); }
    else toast('Error: '+(data.error||'Failed'));
  } catch(e) { toast('Network error'); }
}

// ── Review Modal ──────────────────────────────────────────────
function openReview(bookingId, serviceTitle) {
  selectedRating = 0;
  document.getElementById('reviewBookingId').value = bookingId;
  document.getElementById('reviewServiceName').textContent = `For: ${serviceTitle}`;
  document.getElementById('reviewComment').value = '';
  document.querySelectorAll('#starInput span').forEach(s=>s.classList.remove('on'));
  document.getElementById('modalReview').style.display='flex';
}

document.addEventListener('DOMContentLoaded', ()=>{
  document.querySelectorAll('#starInput span').forEach(star=>{
    star.addEventListener('click', ()=>{
      selectedRating = parseInt(star.dataset.v);
      document.querySelectorAll('#starInput span').forEach(s=>{
        s.classList.toggle('on', parseInt(s.dataset.v) <= selectedRating);
      });
    });
    star.addEventListener('mouseover', ()=>{
      document.querySelectorAll('#starInput span').forEach(s=>{
        s.classList.toggle('on', parseInt(s.dataset.v) <= parseInt(star.dataset.v));
      });
    });
    star.addEventListener('mouseout', ()=>{
      document.querySelectorAll('#starInput span').forEach(s=>{
        s.classList.toggle('on', parseInt(s.dataset.v) <= selectedRating);
      });
    });
  });
  fetchServices();
});

async function submitReview() {
  const booking_id = document.getElementById('reviewBookingId').value;
  const comment    = document.getElementById('reviewComment').value.trim();
  if (!selectedRating) { toast('Please select a star rating!'); return; }

  try {
    const res  = await fetch('get_reviews.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({booking_id, rating: selectedRating, comment})
    });
    const data = await res.json();
    if (data.success) {
      closeModal('modalReview');
      toast('✦ Review saved to database! Thank you ⭐');
      loadBookings();
      fetchServices(); // update avg rating on cards
    } else toast('Error: '+(data.error||'Failed'));
  } catch(e) { toast('Network error'); }
}
</script>
</body>
</html>
