<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEIN HELIOS HOTEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Ultra-Elegant Hotel Color Scheme */
            --bg: #0a0a0a; /* Ultra-deep charcoal */
            --bg-elevated: #121212; /* Elevated charcoal */
            --bg-card: #1a1a1a; /* Premium card background */
            --bg-overlay: rgba(10, 10, 10, 0.95); /* Glass effect */

            --fg: #fafafa; /* Pure white */
            --fg-muted: #b0b0b0; /* Elegant muted */
            --fg-accent: #e8e8e8; /* Premium accent */
            --fg-subtle: #808080; /* Subtle text */

            /* Primary Accent - Platinum Gold */
            --accent: #e8d5b7; /* Warm platinum */
            --accent-light: #f5e6c3; /* Light platinum */
            --accent-dark: #c4a875; /* Deep platinum */
            --accent-glow: rgba(232, 213, 183, 0.3); /* Subtle glow */

            /* Secondary Accents - Royal Navy */
            --secondary: #1a2332; /* Deep navy */
            --secondary-light: #2a3441; /* Light navy */

            --border: #2d2d2d; /* Soft border */
            --border-light: #404040; /* Light border */
            --border-accent: rgba(232, 213, 183, 0.2); /* Accent border */

            --card: #1a1a1a;
            --glow: rgba(232, 213, 183, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--bg);
            color: var(--fg);
            overflow-x: hidden;
            position: relative;
        }

        .font-display {
            font-family: 'Cormorant Garamond', serif;
        }

        /* Subtle animated background */
        .bg-pattern {
            position: fixed;
            inset: 0;
            background-image: 
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(201, 167, 124, 0.08), transparent),
                radial-gradient(ellipse 60% 40% at 100% 100%, rgba(201, 167, 124, 0.05), transparent);
            pointer-events: none;
            z-index: 0;
        }

        /* Floating particles */
        .particle {
            position: fixed;
            width: 2px;
            height: 2px;
            background: var(--accent);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 20s infinite ease-in-out;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0.3; }
            25% { transform: translateY(-100px) translateX(50px); opacity: 0.6; }
            50% { transform: translateY(-50px) translateX(-30px); opacity: 0.4; }
            75% { transform: translateY(-150px) translateX(20px); opacity: 0.5; }
        }

        /* Navigation - Premium Glass Effect */
        .nav-link {
            position: relative;
            color: var(--fg-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 8px 16px;
            border-radius: 8px;
            backdrop-filter: blur(10px);
        }

        .nav-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(232, 213, 183, 0.1) 0%, rgba(232, 213, 183, 0.05) 100%);
            border-radius: 8px;
            opacity: 0;
            transform: scale(0.95);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover {
            color: var(--accent);
            transform: translateY(-1px);
        }

        .nav-link:hover::before {
            opacity: 1;
            transform: scale(1);
            box-shadow: 0 8px 25px rgba(232, 213, 183, 0.15);
        }

        /* Premium Luxury Buttons */
        .btn-luxury {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 20px 52px;
            background: transparent;
            border: 1px solid var(--accent);
            color: var(--accent);
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
        }

        .btn-luxury::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 50%, var(--accent) 100%);
            transform: translateY(100%) scaleX(0.8);
            transform-origin: center;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: -1;
            border-radius: 12px;
        }

        .btn-luxury::after {
            content: '';
            position: absolute;
            inset: -1px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            border-radius: 12px;
            opacity: 0;
            z-index: -2;
            transition: opacity 0.6s ease;
        }

        .btn-luxury:hover {
            color: var(--bg);
            border-color: var(--accent-light);
            box-shadow: 0 0 40px var(--accent-glow), 0 10px 30px rgba(0, 0, 0, 0.3);
            transform: translateY(-3px) scale(1.02);
        }

        .btn-luxury:hover::before {
            transform: translateY(0) scaleX(1);
        }

        .btn-luxury:hover::after {
            opacity: 1;
        }

        .btn-luxury:active {
            transform: scale(0.98) translateY(-1px);
        }

        /* Filled Button Variant */
        .btn-filled {
            background: var(--accent);
            color: var(--bg);
            border-color: var(--accent);
        }

        .btn-filled::before {
            background: linear-gradient(135deg, var(--accent-dark) 0%, var(--accent) 50%, var(--accent-light) 100%);
            transform: translateY(0) scaleX(1);
        }

        .btn-filled:hover {
            background: var(--accent-light);
            color: var(--bg);
            border-color: var(--accent-light);
        }

        /* Hero Section - Ultra Premium */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 140px 0 100px;
            overflow: hidden;
            background:
                radial-gradient(ellipse 120% 80% at 50% -20%, rgba(232, 213, 183, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse 100% 60% at 100% 100%, rgba(26, 35, 50, 0.15) 0%, transparent 50%);
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(232, 213, 183, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(26, 35, 50, 0.08) 0%, transparent 50%);
            animation: heroGlow 8s ease-in-out infinite alternate;
        }

        @keyframes heroGlow {
            0% { opacity: 0.3; }
            100% { opacity: 0.6; }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
        }

        @media (min-width: 768px) {
            .hero-content { padding: 0 80px; }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 16px;
            padding: 12px 24px;
            background: linear-gradient(135deg, rgba(232, 213, 183, 0.1) 0%, rgba(232, 213, 183, 0.05) 100%);
            border: 1px solid rgba(232, 213, 183, 0.3);
            border-radius: 50px;
            margin-bottom: 48px;
            opacity: 0;
            transform: translateY(30px) scale(0.9);
            animation: badgeEntrance 1s ease forwards 0.3s;
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(232, 213, 183, 0.1);
        }

        @keyframes badgeEntrance {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .hero-badge span {
            width: 8px;
            height: 8px;
            background: var(--accent);
            border-radius: 50%;
            animation: badgePulse 3s infinite ease-in-out;
            box-shadow: 0 0 10px var(--accent-glow);
        }

        @keyframes badgePulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
                box-shadow: 0 0 10px var(--accent-glow);
            }
            50% {
                opacity: 0.7;
                transform: scale(0.8);
                box-shadow: 0 0 20px var(--accent-glow);
            }
        }

        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(56px, 12vw, 120px);
            font-weight: 700;
            line-height: 1.05;
            letter-spacing: -0.03em;
            margin-bottom: 40px;
            opacity: 0;
            transform: translateY(50px);
            animation: titleSlide 1.2s ease forwards 0.6s;
        }

        @keyframes titleSlide {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-title span {
            color: var(--accent);
            background: none;
            position: relative;
        }

        .hero-title span::after {
            display: none;
        }
            border-radius: 2px;
            animation: underlineGlow 2s ease-in-out infinite alternate;
        }

        @keyframes underlineGlow {
            0% { opacity: 0.6; transform: scaleX(0.8); }
            100% { opacity: 1; transform: scaleX(1); }
        }

        .hero-subtitle {
            font-size: 20px;
            font-weight: 400;
            color: var(--fg-muted);
            max-width: 600px;
            line-height: 1.7;
            margin-bottom: 64px;
            opacity: 0;
            transform: translateY(30px);
            animation: subtitleFade 1s ease forwards 0.9s;
        }

        @keyframes subtitleFade {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-buttons {
            display: flex;
            gap: 32px;
            opacity: 0;
            transform: translateY(30px);
            animation: buttonsSlide 1s ease forwards 1.1s;
        }

        @keyframes buttonsSlide {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Luxury Cards - Premium Enhancement */
        .luxury-card {
            background: linear-gradient(135deg, var(--card) 0%, rgba(26, 26, 26, 0.9) 100%);
            border: 1px solid var(--border);
            padding: 56px;
            position: relative;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .luxury-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--accent) 50%, transparent 100%);
            opacity: 0;
            transition: all 0.6s ease;
            transform: scaleX(0);
            transform-origin: center;
        }

        .luxury-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(232, 213, 183, 0.03) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.6s ease;
            border-radius: 20px;
        }

        .luxury-card:hover {
            border-color: var(--border-accent);
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.4),
                0 0 40px var(--accent-glow);
            transform: translateY(-8px) scale(1.02);
        }

        .luxury-card:hover::before {
            opacity: 1;
            transform: scaleX(1);
        }

        .luxury-card:hover::after {
            opacity: 1;
        }

        .card-number {
            font-family: 'Cormorant Garamond', serif;
            font-size: 56px;
            font-weight: 300;
            color: var(--accent);
            opacity: 0.4;
            line-height: 1;
            margin-bottom: 24px;
            transition: all 0.4s ease;
        }

        .luxury-card:hover .card-number {
            opacity: 0.8;
            transform: scale(1.1);
        }

        .card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px;
            font-weight: 600;
            margin: 0 0 20px;
            color: var(--fg);
            transition: color 0.4s ease;
        }

        .luxury-card:hover .card-title {
            color: var(--accent);
        }

        .card-text {
            color: var(--fg-muted);
            line-height: 1.8;
            font-size: 16px;
            transition: color 0.4s ease;
        }

        .luxury-card:hover .card-text {
            color: var(--fg-accent);
        }

        /* Section */
        .section {
            position: relative;
            z-index: 1;
            padding: 120px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-label {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 20px;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(36px, 6vw, 56px);
            font-weight: 600;
            margin-bottom: 24px;
        }

        .section-text {
            color: var(--fg-muted);
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Stats Grid - Premium Enhancement */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 48px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stat-item {
            text-align: center;
            padding: 56px 32px;
            background: linear-gradient(135deg, var(--card) 0%, rgba(26, 26, 26, 0.9) 100%);
            border: 1px solid var(--border);
            border-radius: 20px;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(20px);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .stat-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(232, 213, 183, 0.02) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.6s ease;
        }

        .stat-item:hover {
            border-color: var(--border-accent);
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.3),
                0 0 30px var(--accent-glow);
            transform: translateY(-12px) scale(1.05);
        }

        .stat-item:hover::before {
            opacity: 1;
        }

        .stat-number {
            font-family: 'Cormorant Garamond', serif;
            font-size: 56px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 16px;
            transition: all 0.4s ease;
        }

        .stat-item:hover .stat-number {
            transform: scale(1.1);
            filter: brightness(1.2);
        }

        .stat-label {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--fg-muted);
            transition: color 0.4s ease;
        }

        .stat-item:hover .stat-label {
            color: var(--accent);
        }

        /* CTA Section - Premium Enhancement */
        .cta-section {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 120px 0;
            background: linear-gradient(135deg, var(--bg-elevated) 0%, var(--bg) 100%);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 30% 20%, rgba(232, 213, 183, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(26, 35, 50, 0.08) 0%, transparent 50%);
            animation: ctaGlow 6s ease-in-out infinite alternate;
        }

        @keyframes ctaGlow {
            0% { opacity: 0.4; }
            100% { opacity: 0.8; }
        }

        .cta-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(40px, 6vw, 64px);
            font-weight: 600;
            margin-bottom: 32px;
            background: linear-gradient(135deg, var(--fg) 0%, var(--fg-accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            z-index: 1;
        }

        .cta-text {
            color: var(--fg-muted);
            font-size: 18px;
            margin-bottom: 56px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }

        /* Footer */
        .footer {
            position: relative;
            z-index: 1;
            padding: 60px 0;
            background: var(--bg);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.1em;
        }

        .footer-links {
            display: flex;
            gap: 40px;
        }

        .footer-link {
            color: var(--fg-muted);
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--fg);
        }

        .copyright {
            color: var(--fg-muted);
            font-size: 11px;
            text-align: center;
            padding-top: 40px;
            margin-top: 40px;
            border-top: 1px solid var(--border);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .hero-buttons {
                flex-direction: column;
            }

            .btn-luxury {
                width: 100%;
                justify-content: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                flex-direction: column;
                gap: 30px;
                text-align: center;
            }

            .footer-links {
                gap: 20px;
            }
        }

        /* Entrance animations */
        .fade-in {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── Homepage Room Preview Cards ── */
        .rooms-preview-section {
            position: relative;
            z-index: 1;
            padding: 100px 0 120px;
            background: var(--bg);
        }

        .rooms-preview-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 40% at 50% 0%, rgba(232, 213, 183, 0.05) 0%, transparent 60%);
            pointer-events: none;
        }

        .rooms-preview-header {
            text-align: center;
            margin-bottom: 64px;
        }

        .rooms-preview-label {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 18px;
        }

        .rooms-preview-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(32px, 5vw, 52px);
            font-weight: 600;
            color: var(--fg);
            letter-spacing: -0.01em;
        }

        .rooms-preview-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .room-preview-card {
            flex: 1 1 180px;
            max-width: 240px;
            min-width: 160px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 44px 32px 40px;
            background: linear-gradient(160deg, #1a1a1a 0%, #141414 100%);
            border: 1px solid var(--border);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            opacity: 0;
            transform: translateY(30px);
            animation: previewCardIn 0.7s ease forwards;
        }

        .room-preview-card:nth-child(1) { animation-delay: 0.1s; }
        .room-preview-card:nth-child(2) { animation-delay: 0.22s; }
        .room-preview-card:nth-child(3) { animation-delay: 0.34s; }
        .room-preview-card:nth-child(4) { animation-delay: 0.46s; }

        @keyframes previewCardIn {
            to { opacity: 1; transform: translateY(0); }
        }

        /* top gold accent line */
        .room-preview-card::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            border-radius: 2px;
            transition: transform 0.5s ease;
        }

        /* subtle inner glow on hover */
        .room-preview-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(232, 213, 183, 0.06) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.5s ease;
            border-radius: 20px;
        }

        .room-preview-card:hover {
            border-color: rgba(232, 213, 183, 0.3);
            box-shadow:
                0 24px 60px rgba(0, 0, 0, 0.45),
                0 0 40px rgba(232, 213, 183, 0.08);
            transform: translateY(-10px);
        }

        .room-preview-card:hover::before {
            transform: translateX(-50%) scaleX(1);
        }

        .room-preview-card:hover::after {
            opacity: 1;
        }

        .preview-stars {
            display: flex;
            gap: 5px;
            justify-content: center;
            margin-bottom: 24px;
        }

        .preview-star {
            font-size: 14px;
            color: var(--accent);
            line-height: 1;
            transition: transform 0.3s ease;
        }

        .room-preview-card:hover .preview-star {
            transform: scale(1.15);
        }

        .preview-room-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--fg);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 10px;
            transition: color 0.4s ease;
            line-height: 1.2;
        }

        .room-preview-card:hover .preview-room-name {
            color: var(--accent);
        }

        .preview-divider {
            width: 32px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent-dark), transparent);
            margin: 0 auto 12px;
            transition: width 0.4s ease;
        }

        .room-preview-card:hover .preview-divider {
            width: 56px;
        }

        .preview-room-type {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--fg-subtle);
            transition: color 0.4s ease;
        }

        .room-preview-card:hover .preview-room-type {
            color: var(--fg-muted);
        }


    </style>
</head>
<body>
    <!-- Background Pattern -->
    <div class="bg-pattern"></div>
    
    <!-- Floating Particles -->
    <div class="particle" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="top: 40%; left: 80%; animation-delay: 5s;"></div>
    <div class="particle" style="top: 70%; left: 20%; animation-delay: 10s;"></div>
    <div class="particle" style="top: 30%; left: 60%; animation-delay: 15s;"></div>
    <div class="particle" style="top: 80%; left: 90%; animation-delay: 8s;"></div>

     <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-[#0f0f0f]/80 backdrop-blur-xl border-b border-[#2a2a2a]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.svg') }}" alt="SEIN HELIOS" class="h-8 lg:h-10 w-auto">
                    <span class="font-display text-lg lg:text-xl font-semibold tracking-wider" style="color: var(--accent);">SEIN HELIOS</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-4 lg:gap-6">
                    <a href="{{ route('home') }}" class="nav-link text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors duration-300">HOME</a>
                    <a href="{{ route('rooms.browse') }}" class="nav-link text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors duration-300">ROOMS</a>
                    <a href="{{ route('facilities') }}" class="nav-link text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors duration-300">FACILITIES</a>
                    <a href="{{ route('about') }}" class="nav-link text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors duration-300">ABOUT US</a>
                    @guest
                        <a href="#modal-login" class="px-5 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                            Sign In
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                            Dashboard
                        </a>
                    @endguest
                </div>

                <!-- Mobile Hamburger -->
                <button id="mobile-menu-btn" class="md:hidden flex flex-col gap-1.5 p-2" aria-label="Open menu">
                    <span class="block w-6 h-0.5 bg-[#f5f5f0] transition-all"></span>
                    <span class="block w-6 h-0.5 bg-[#f5f5f0] transition-all"></span>
                    <span class="block w-6 h-0.5 bg-[#f5f5f0] transition-all"></span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div id="mobile-menu" class="hidden md:hidden bg-[#0f0f0f] border-t border-[#2a2a2a] px-6 py-4 space-y-3">
            <a href="{{ route('home') }}" class="block text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] py-2 transition-colors">HOME</a>
            <a href="{{ route('rooms.browse') }}" class="block text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] py-2 transition-colors">ROOMS</a>
            <a href="{{ route('facilities') }}" class="block text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] py-2 transition-colors">FACILITIES</a>
            <a href="{{ route('about') }}" class="block text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] py-2 transition-colors">ABOUT US</a>
            @guest
                <a href="#modal-login" class="block w-full text-center px-5 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors">Sign In</a>
            @else
                <a href="{{ url('/dashboard') }}" class="block w-full text-center px-5 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors">Dashboard</a>
            @endguest
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">
                Where<br>
                <span>Elegance</span> Meets Serenity
            </h1>
            
            <p class="hero-subtitle">
                Discover unparalleled luxury in the heart of the city. Our meticulously crafted suites offer an oasis of tranquility with bespoke amenities and personalized service.
            </p>
            
            <div class="hero-buttons">
                @guest
                    <a href="#modal-register" class="btn-luxury btn-filled" style="padding: 18px 48px; font-size: 12px;">
                        Reserve Now
                    </a>
                @else
                    <a href="{{ url('/dashboard') }}" class="btn-luxury btn-filled" style="padding: 18px 48px; font-size: 12px;">
                        Access Dashboard
                    </a>
                @endguest
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-1/4 right-0 w-96 h-96 bg-[var(--accent)] opacity-5 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-1/4 left-0 w-96 h-96 bg-[var(--accent)] opacity-5 rounded-full blur-3xl -z-10"></div>
    </section>

    <!-- Room Preview Section -->
    @if(isset($roomCategories) && $roomCategories->count())
    <section class="rooms-preview-section">
        <div class="rooms-preview-header fade-in">
            <span class="rooms-preview-label">Accommodations</span>
            <h2 class="rooms-preview-title">Our Rooms &amp; Suites</h2>
        </div>

        <div class="rooms-preview-grid">
            @foreach($roomCategories as $category)
            <div class="room-preview-card">
                <!-- 5-Star Rating -->
                <div class="preview-stars">
                    <span class="preview-star">★</span>
                    <span class="preview-star">★</span>
                    <span class="preview-star">★</span>
                    <span class="preview-star">★</span>
                    <span class="preview-star">★</span>
                </div>

                <!-- Room Name -->
                <div class="preview-room-name">{{ $category->name }}</div>

                <!-- Divider -->
                <div class="preview-divider"></div>

                <!-- Room Type -->
                <div class="preview-room-type">Room Type: {{ $category->name }}</div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Auth Modals (Pure CSS - No JavaScript) -->
    <x-auth-modals />

    <script>
        // Scroll reveal animations only (no modal logic)
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

        // Particle mouse follow effect
        document.addEventListener('DOMContentLoaded', () => {
            const particles = document.querySelectorAll('.particle');
            
            document.addEventListener('mousemove', (e) => {
                const mouseX = e.clientX / window.innerWidth;
                const mouseY = e.clientY / window.innerHeight;
                
                particles.forEach((particle, index) => {
                    const speed = (index + 1) * 0.5;
                    const x = (mouseX - 0.5) * speed;
                    const y = (mouseY - 0.5) * speed;
                    
                    particle.style.transform = `translate(${x}px, ${y}px)`;
                });
            });
        });
    </script>
</body>
</html>
