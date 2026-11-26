<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-SAPRAS JTIK — Universitas Negeri Makassar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-navy: #092552;
            --brand-navy-deep: #041026;
            --brand-navy-mid: #081e44;
            --brand-orange: #ea580c;
            --brand-orange-bright: #f97316;
            --brand-navy-dark: #061836;
            --brand-blue-sub: #0284c7;
            --ease-editorial: cubic-bezier(0.76, 0, 0.24, 1);
            --ease-out-expo: cubic-bezier(0.16, 1, 0.3, 1);
            --ease-out-quart: cubic-bezier(0.25, 1, 0.5, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #07152b;
            color: #0f172a;
            min-height: 100vh;
        }

        body.intro-active {
            overflow: hidden;
        }

        /* =========================================================
           SLIDE 1: DEEP NAVY UNM EDITORIAL OPENING (AWWWARDS EDITION)
           5 Staggered Vertical Columns + Swiss Framing + Ghost Type
           + Per-Character Wave Reveal (ONLY UNM + SI-SAPRAS)
           ========================================================= */
        .intro-stage {
            position: fixed;
            inset: 0;
            z-index: 9999;
            overflow: hidden;
            cursor: pointer;
            user-select: none;
        }

        .intro-stage.done {
            display: none;
        }

        /* 1. FIVE VERTICAL ARCHITECTURAL CURTAIN COLUMNS */
        .curtain-columns {
            position: absolute;
            inset: 0;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            z-index: 1;
        }

        .curtain-col {
            position: relative;
            height: 100%;
            background: linear-gradient(165deg, #040e22 0%, #071c3f 52%, #0c2b5e 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.045);
            transform: translateY(0);
            will-change: transform;
        }

        .curtain-col:last-child {
            border-right: none;
        }

        /* Razor-sharp orange + white leading hem along each column bottom */
        .curtain-col::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--brand-orange) 0%, var(--brand-orange-bright) 70%, rgba(255, 255, 255, 0.85) 100%);
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .intro-stage.lifting .curtain-col::after {
            opacity: 1;
        }

        .intro-stage.lifting .curtain-col:nth-child(1) { animation: colLift 0.96s var(--ease-editorial) 0.00s forwards; }
        .intro-stage.lifting .curtain-col:nth-child(2) { animation: colLift 0.96s var(--ease-editorial) 0.06s forwards; }
        .intro-stage.lifting .curtain-col:nth-child(3) { animation: colLift 0.96s var(--ease-editorial) 0.12s forwards; }
        .intro-stage.lifting .curtain-col:nth-child(4) { animation: colLift 0.96s var(--ease-editorial) 0.18s forwards; }
        .intro-stage.lifting .curtain-col:nth-child(5) { animation: colLift 0.96s var(--ease-editorial) 0.24s forwards; }

        /* 2. SUBTLE FILM GRAIN TEXTURE (CINEMA / PRINT DEPTH) */
        .intro-grain {
            position: absolute;
            inset: 0;
            z-index: 2;
            opacity: 0.036;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 240 240' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            transition: opacity 0.35s ease;
        }

        .intro-stage.lifting .intro-grain {
            opacity: 0;
        }

        /* 3. GIANT GHOST WATERMARK TYPOGRAPHY (PARALLAX DRIFT) */
        .intro-ghost-wrap {
            position: absolute;
            inset: 0;
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            overflow: hidden;
            transition: opacity 0.45s ease;
        }

        .intro-ghost-text {
            font-size: clamp(10rem, 23vw, 24rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 0.9;
            white-space: nowrap;
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.055);
            opacity: 0;
            transform: translateX(3.5%);
            will-change: transform, opacity;
        }

        .intro-stage.playing .intro-ghost-text {
            animation: ghostDrift 3.6s var(--ease-out-quart) 0.1s forwards;
        }

        .intro-stage.exit-content .intro-ghost-wrap {
            opacity: 0;
        }

        /* 4. SWISS EDITORIAL FRAME & 4-CORNER MICRO METADATA */
        .editorial-frame {
            position: absolute;
            inset: clamp(18px, 2.8vw, 34px);
            z-index: 4;
            border: 1px solid rgba(255, 255, 255, 0.075);
            pointer-events: none;
            opacity: 0;
            transform: scale(0.985);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .intro-stage.playing .editorial-frame {
            animation: frameAppear 0.9s var(--ease-out-expo) 0.12s forwards;
        }

        .intro-stage.exit-content .editorial-frame {
            opacity: 0 !important;
            transform: scale(1.015);
        }

        .corner-meta {
            position: absolute;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.16em;
            color: rgba(203, 213, 225, 0.72);
            overflow: hidden;
            line-height: 1.4;
        }

        .corner-meta span {
            display: inline-block;
            transform: translateY(115%);
            opacity: 0;
            will-change: transform, opacity;
        }

        .intro-stage.playing .corner-meta span {
            animation: lineRise 0.75s var(--ease-out-expo) 0.28s forwards;
        }

        .corner-tl { top: 18px; left: 22px; }
        .corner-tr { top: 18px; right: 22px; font-variant-numeric: tabular-nums; display: flex; align-items: center; gap: 6px; }
        .corner-bl { bottom: 18px; left: 22px; }
        .corner-br { bottom: 18px; right: 22px; }

        .slide-counter-box {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .counter-digit-mask {
            display: inline-block;
            height: 1.4em;
            overflow: hidden;
            vertical-align: top;
        }

        .counter-digit-track {
            display: flex;
            flex-direction: column;
            transition: transform 0.55s var(--ease-editorial);
            color: var(--brand-orange-bright);
            font-weight: 800;
        }

        .intro-stage.to-slide-two .counter-digit-track {
            transform: translateY(-50%);
        }

        /* Editorial bottom hairline thread inside frame */
        .editorial-thread {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            background: rgba(255, 255, 255, 0.06);
            overflow: hidden;
        }

        .editorial-thread-fill {
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.45) 0%, var(--brand-orange-bright) 100%);
            transform-origin: left center;
            transform: scaleX(0);
            will-change: transform;
        }

        .intro-stage.playing .editorial-thread-fill {
            animation: threadProgress 2.55s var(--ease-out-quart) 0.14s forwards;
        }

        /* 5. CENTERPIECE LOCKUP (ONLY UNM EMBLEM + SI-SAPRAS) */
        .intro-center {
            position: relative;
            z-index: 6;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .intro-lockup {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.58s var(--ease-editorial), opacity 0.45s ease, filter 0.45s ease;
            will-change: transform, opacity, filter;
        }

        .intro-stage.exit-content .intro-lockup {
            transform: translateY(-24px) scale(0.94);
            opacity: 0;
            filter: blur(4px);
        }

        /* Emblem UNM (True Transparent PNG inverted to crisp pure white) */
        .intro-emblem-slot {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 4px;
        }

        .intro-emblem-img {
            height: clamp(72px, 10.5vw, 104px);
            width: auto;
            display: block;
            object-fit: contain;
            filter: brightness(0) invert(1);
            clip-path: inset(100% 0 0 0);
            transform: translateY(24px) scale(1.1) rotate(-6deg);
            opacity: 0;
            will-change: transform, clip-path, opacity;
        }

        .intro-stage.playing .intro-emblem-img {
            animation: emblemAperture 0.92s var(--ease-out-expo) 0.14s forwards;
        }

        /* Vertical Architectural Divider */
        .intro-divider-wrap {
            width: 0;
            height: clamp(58px, 8.2vw, 82px);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            will-change: width;
        }

        .intro-stage.playing .intro-divider-wrap {
            animation: expandDividerSpace 0.88s var(--ease-editorial) 0.90s forwards;
        }

        .intro-divider-line {
            width: 1.5px;
            height: 100%;
            background: linear-gradient(180deg, var(--brand-orange-bright) 0%, rgba(255, 255, 255, 0.7) 48%, rgba(255, 255, 255, 0.14) 100%);
            transform-origin: top center;
            transform: scaleY(0);
            will-change: transform;
        }

        .intro-stage.playing .intro-divider-line {
            animation: drawVerticalRule 0.68s var(--ease-out-expo) 1.04s forwards;
        }

        /* Per-Character Kinetic Wordmark */
        .intro-wordmark-slot {
            max-width: 0;
            overflow: hidden;
            white-space: nowrap;
            will-change: max-width;
        }

        .intro-stage.playing .intro-wordmark-slot {
            animation: openWordmarkSlot 0.94s var(--ease-editorial) 0.90s forwards;
        }

        .intro-wordmark-inner {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 2px;
        }

        .intro-title-row {
            display: flex;
            align-items: baseline;
            gap: 12px;
            font-size: clamp(2.15rem, 5.1vw, 3.9rem);
            font-weight: 800;
            line-height: 1.04;
            letter-spacing: -0.03em;
        }

        .word-group {
            display: inline-flex;
            overflow: hidden;
            padding: 3px 0;
        }

        .word-group.w-white { color: #ffffff; }
        .word-group.w-orange { color: var(--brand-orange-bright); }

        .char-item {
            display: inline-block;
            transform: translateY(118%) rotate(5deg);
            opacity: 0;
            will-change: transform, opacity;
        }

        .intro-stage.playing .char-item {
            animation: charWaveIn 0.78s var(--ease-out-expo) calc(1.06s + (var(--i) * 34ms)) forwards;
        }

        .intro-sub-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 9px;
        }

        .intro-sub-accent {
            width: 0;
            height: 2px;
            background: var(--brand-orange-bright);
            flex-shrink: 0;
        }

        .intro-stage.playing .intro-sub-accent {
            animation: subBarExpand 0.7s var(--ease-out-expo) 1.56s forwards;
        }

        .intro-sub-mask {
            overflow: hidden;
        }

        .intro-sub {
            font-size: clamp(0.66rem, 1.05vw, 0.82rem);
            font-weight: 600;
            letter-spacing: 0.18em;
            color: rgba(203, 213, 225, 0.82);
            transform: translateY(118%);
            opacity: 0;
            will-change: transform, opacity;
        }

        .intro-stage.playing .intro-sub {
            animation: lineRise 0.72s var(--ease-out-expo) 1.62s forwards;
        }

        /* =========================================================
           SLIDE 2: PORTAL LOGIN SI-SAPRAS (EXACT PRODUCTION LAYOUT
           WITH SYNCHRONIZED EDITORIAL ENTRANCE CHOREOGRAPHY)
           ========================================================= */
        .slide-two-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #07152b;
        }

        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-portal-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 6px;
            border: 1.5px solid #cbd5e1;
            background: #f8fafc;
            color: var(--brand-navy);
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.15s ease;
        }

        .nav-portal-link:hover {
            background: #eff6ff;
            border-color: var(--brand-navy);
        }

        .portal-role-tag {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 5px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: var(--brand-navy);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.2px;
            margin-bottom: 10px;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 12px;
            line-height: 1.45;
            margin-bottom: 16px;
            text-align: left;
        }

        .portal-switch-box {
            margin-top: 18px;
            padding-top: 14px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .portal-switch-box a {
            color: var(--brand-navy);
            font-weight: 700;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
        }

        .nav-logo-unm {
            height: 48px;
            width: auto;
            object-fit: contain;
        }

        .nav-logo-blu {
            height: 44px;
            width: auto;
            object-fit: contain;
        }

        .brand-text-col {
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.15;
        }

        .brand-title-row {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .brand-main-navy {
            font-size: 24px;
            font-weight: 800;
            color: var(--brand-navy);
            letter-spacing: -0.5px;
        }

        .brand-main-orange {
            font-size: 24px;
            font-weight: 800;
            color: var(--brand-orange);
            letter-spacing: -0.5px;
        }

        .brand-sub-name {
            font-size: 13.5px;
            color: #64748b;
            font-weight: 600;
            margin-top: 2px;
            letter-spacing: 0.1px;
        }

        .hero-section {
            flex: 1;
            background: linear-gradient(135deg, #071936 0%, #0d2855 50%, #133a78 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 40px 48px;
        }

        .hero-photo-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 70%;
            height: 100%;
            background-image: url('{{ asset("images/bg-ruang-kelas.png") }}');
            background-size: cover;
            background-position: center left;
            opacity: 0.18;
            pointer-events: none;
            z-index: 1;
            -webkit-mask-image: linear-gradient(to right, rgba(0,0,0,1) 0%, rgba(0,0,0,0.85) 40%, rgba(0,0,0,0.2) 75%, rgba(0,0,0,0) 100%);
            mask-image: linear-gradient(to right, rgba(0,0,0,1) 0%, rgba(0,0,0,0.85) 40%, rgba(0,0,0,0.2) 75%, rgba(0,0,0,0) 100%);
            will-change: transform;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -10%;
            left: -5%;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(14, 116, 144, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -15%;
            right: 25%;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(234, 88, 12, 0.08) 0%, transparent 65%);
            pointer-events: none;
        }

        .hero-container {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.15fr 0.9fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-left {
            color: #ffffff;
            max-width: 620px;
        }

        .welcome-pill {
            display: inline-block;
            background: #ffffff;
            color: var(--brand-navy);
            padding: 7px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .hero-headline {
            font-size: 46px;
            font-weight: 800;
            line-height: 1.18;
            letter-spacing: -1px;
            margin-bottom: 18px;
            color: #ffffff;
        }

        .headline-line-mask {
            display: block;
            overflow: hidden;
            padding-bottom: 3px;
        }

        .headline-line-text {
            display: block;
        }

        .hero-description {
            font-size: 15.5px;
            line-height: 1.65;
            color: #cbd5e1;
            margin-bottom: 32px;
        }

        .benefit-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .benefit-badge {
            background: #ffffff;
            color: var(--brand-navy);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 12.5px;
            font-weight: 700;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .check-circle {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--brand-orange);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 900;
        }

        .hero-right {
            display: flex;
            justify-content: flex-end;
        }

        .siakad-card {
            background: #ffffff;
            width: 100%;
            max-width: 430px;
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 25px 40px -10px rgba(0, 0, 0, 0.35);
            text-align: center;
        }

        .card-brand-header {
            margin-bottom: 24px;
        }

        .card-title-navy {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.4px;
            color: var(--brand-navy);
            margin-bottom: 6px;
        }

        .card-subtitle-muted {
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
            line-height: 1.4;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .label-main {
            font-weight: 700;
            color: #1e293b;
        }

        .label-hint {
            font-size: 11px;
            color: #94a3b8;
        }

        .form-input {
            width: 100%;
            padding: 11px 14px;
            font-size: 13.5px;
            font-family: inherit;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: all 0.15s ease;
            color: #0f172a;
            background: #ffffff;
        }

        .form-input:focus {
            border-color: var(--brand-navy);
            box-shadow: 0 0 0 3px rgba(9, 37, 82, 0.12);
        }

        input::-ms-reveal,
        input::-ms-clear {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        .password-wrap {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .password-wrap .form-input {
            padding-right: 44px;
        }

        .toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748B;
            transition: color 0.15s ease;
            z-index: 2;
        }

        .toggle-btn:hover {
            color: var(--brand-navy);
        }

        .toggle-btn svg {
            stroke: currentColor;
            display: block;
        }

        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            margin: 12px 0 20px 0;
        }

        .options-row label {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #475569;
            cursor: pointer;
        }

        .options-row a {
            color: var(--brand-navy);
            text-decoration: underline;
            text-underline-offset: 3px;
            font-weight: 700;
        }

        .btn-submit-main {
            width: 100%;
            background: var(--brand-navy);
            color: #ffffff;
            padding: 13px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 0 4px 6px -1px rgba(9, 37, 82, 0.2);
        }

        .btn-submit-main:hover {
            background: var(--brand-navy-dark);
            transform: translateY(-1px);
        }

        .btn-submit-main:disabled {
            background: #64748b;
            opacity: 0.72;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 12px;
            line-height: 1.45;
            margin-bottom: 16px;
            text-align: left;
        }

        .alert-warning {
            background: #fffbeb;
            color: #92400e;
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 12px;
            line-height: 1.45;
            margin-bottom: 16px;
            text-align: left;
        }

        /* =========================================================
           SLIDE 2 SYNCHRONIZED EDITORIAL ENTRANCE
           ========================================================= */
        .slide-two-shell.waiting .top-navbar {
            opacity: 0;
            transform: translateY(-18px);
        }

        .slide-two-shell.waiting .hero-photo-layer {
            transform: scale(1.1);
        }

        .slide-two-shell.waiting .welcome-pill,
        .slide-two-shell.waiting .hero-description,
        .slide-two-shell.waiting .benefit-badge {
            opacity: 0;
            transform: translateY(20px);
        }

        .slide-two-shell.waiting .headline-line-text {
            transform: translateY(114%);
            opacity: 0;
        }

        .slide-two-shell.waiting .siakad-card {
            opacity: 0;
            transform: translateY(38px) scale(0.985);
        }

        .slide-two-shell.revealed .top-navbar {
            animation: navSettle 0.85s var(--ease-out-expo) 0.18s forwards;
        }

        .slide-two-shell.revealed .hero-photo-layer {
            animation: photoDollyOut 1.85s var(--ease-out-expo) 0.12s forwards;
        }

        .slide-two-shell.revealed .welcome-pill {
            animation: fadeLiftIn 0.78s var(--ease-out-expo) 0.30s forwards;
        }

        .slide-two-shell.revealed .headline-line-1 {
            animation: lineRise 0.88s var(--ease-out-expo) 0.36s forwards;
        }

        .slide-two-shell.revealed .headline-line-2 {
            animation: lineRise 0.88s var(--ease-out-expo) 0.47s forwards;
        }

        .slide-two-shell.revealed .hero-description {
            animation: fadeLiftIn 0.85s var(--ease-out-expo) 0.58s forwards;
        }

        .slide-two-shell.revealed .benefit-badge:nth-child(1) {
            animation: fadeLiftIn 0.72s var(--ease-out-expo) 0.68s forwards;
        }

        .slide-two-shell.revealed .benefit-badge:nth-child(2) {
            animation: fadeLiftIn 0.72s var(--ease-out-expo) 0.76s forwards;
        }

        .slide-two-shell.revealed .benefit-badge:nth-child(3) {
            animation: fadeLiftIn 0.72s var(--ease-out-expo) 0.84s forwards;
        }

        .slide-two-shell.revealed .siakad-card {
            animation: cardElevate 0.96s var(--ease-out-expo) 0.44s forwards;
        }

        /* Modal Bantuan Sandi */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
            z-index: 10000;
            padding: 16px;
        }

        .modal-box {
            background: #ffffff;
            width: 100%;
            max-width: 400px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            padding: 24px;
            text-align: left;
        }

        .modal-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }

        .modal-title-text {
            font-size: 14px;
            font-weight: 800;
            color: var(--brand-navy);
        }

        .modal-close-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #64748b;
            cursor: pointer;
            line-height: 1;
        }

        .maba-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin: 12px 0 16px 0;
        }

        .maba-btn {
            border: 1px solid #fed7aa;
            border-radius: 8px;
            padding: 9px;
            background: #fff7ed;
            color: var(--brand-orange);
            font-weight: 700;
            font-size: 12px;
            cursor: pointer;
            text-align: center;
            transition: all 0.15s ease;
        }

        .maba-btn:hover {
            background: #ffedd5;
        }

        /* =========================================================
           KEYFRAMES
           ========================================================= */
        @keyframes frameAppear {
            0% { opacity: 0; transform: scale(0.985); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes ghostDrift {
            0% { opacity: 0; transform: translateX(3.5%); }
            20% { opacity: 1; }
            100% { opacity: 1; transform: translateX(-3.5%); }
        }

        @keyframes emblemAperture {
            0% {
                clip-path: inset(100% 0 0 0);
                transform: translateY(24px) scale(1.1) rotate(-6deg);
                opacity: 0;
            }
            20% {
                opacity: 1;
            }
            100% {
                clip-path: inset(0% 0 0 0);
                transform: translateY(0) scale(1) rotate(0deg);
                opacity: 1;
            }
        }

        @keyframes expandDividerSpace {
            0% { width: 0; }
            100% { width: clamp(28px, 4vw, 50px); }
        }

        @keyframes drawVerticalRule {
            0% { transform: scaleY(0); }
            100% { transform: scaleY(1); }
        }

        @keyframes openWordmarkSlot {
            0% { max-width: 0; }
            100% { max-width: 620px; }
        }

        @keyframes charWaveIn {
            0% {
                transform: translateY(118%) rotate(5deg);
                opacity: 0;
            }
            18% {
                opacity: 1;
            }
            100% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
        }

        @keyframes subBarExpand {
            0% { width: 0; }
            100% { width: 28px; }
        }

        @keyframes lineRise {
            0% {
                transform: translateY(115%);
                opacity: 0;
            }
            18% {
                opacity: 1;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes threadProgress {
            0% { transform: scaleX(0); }
            100% { transform: scaleX(1); }
        }

        @keyframes colLift {
            0% { transform: translateY(0); }
            100% { transform: translateY(-103%); }
        }

        @keyframes navSettle {
            0% { opacity: 0; transform: translateY(-18px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes photoDollyOut {
            0% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes fadeLiftIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes cardElevate {
            0% { opacity: 0; transform: translateY(38px) scale(0.985); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        @media (max-width: 1000px) {
            .top-navbar {
                padding: 12px 20px;
            }
            .hero-section {
                padding: 40px 20px;
            }
            .hero-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .hero-left {
                text-align: center;
                max-width: 100%;
            }
            .hero-headline {
                font-size: 34px;
            }
            .benefit-badges {
                justify-content: center;
            }
            .hero-right {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .top-navbar {
                padding: 10px 14px;
            }
            .nav-portal-link {
                padding: 6px 10px;
                font-size: 11px;
            }
            .nav-brand {
                gap: 8px;
            }
            .nav-logo-unm {
                height: 32px;
            }
            .nav-logo-blu {
                height: 28px;
            }
            .brand-main-navy,
            .brand-main-orange {
                font-size: 16.5px;
            }
            .brand-sub-name {
                font-size: 10.5px;
            }
            .hero-section {
                padding: 22px 14px 32px 14px;
                align-items: flex-start;
            }
            .hero-container {
                gap: 20px;
            }
            .hero-right {
                width: 100%;
            }
            .siakad-card {
                max-width: 100%;
                padding: 24px 18px;
                border-radius: 14px;
            }
            .card-title-navy {
                font-size: 20px;
            }
            .hero-headline {
                font-size: 24px;
                line-height: 1.2;
                margin-bottom: 10px;
            }
            .hero-description {
                font-size: 12.5px;
                line-height: 1.55;
                margin-bottom: 14px;
            }
            .welcome-pill {
                margin-bottom: 10px;
                font-size: 11px;
                padding: 5px 12px;
            }
        }

        @media (max-width: 640px) {
            .corner-meta {
                font-size: 9px;
                letter-spacing: 0.15em;
            }
            .corner-tl { top: 12px; left: 14px; }
            .corner-tr { top: 12px; right: 14px; }
            .corner-bl { bottom: 12px; left: 14px; }
            .corner-br { bottom: 12px; right: 14px; }
            .intro-emblem-img {
                height: 60px;
            }
            .intro-divider-wrap {
                height: 50px;
            }
            .intro-title-row {
                gap: 8px;
                font-size: clamp(1.55rem, 6.4vw, 2.2rem);
            }
            .intro-sub {
                font-size: 11.5px;
                letter-spacing: 0.12em;
            }
            .intro-sub-accent {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .label-row,
            .options-row {
                flex-wrap: wrap;
                gap: 6px 10px;
            }
            .form-input {
                font-size: 16px;
                min-height: 44px;
                padding: 10px 12px;
            }
            .password-wrap .form-input {
                padding-right: 44px;
            }
            .btn-submit-main,
            .maba-btn {
                min-height: 44px;
            }
            .benefit-badges {
                gap: 8px;
            }
            .benefit-badge {
                font-size: 11.5px;
                padding: 6px 12px;
            }
            .maba-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
@php
    $lockSec = (int) ($lockoutSeconds ?? 0);
    $lockStageMin = (int) ($lockoutStageMinutes ?? 3);
    $lockAtt = (int) ($lockoutAttempts ?? 3);
    $mailAlertSent = (bool) ($emailAlertSent ?? false);
    $lockedUserIdent = $lockedIdent ?? '';
    $remAtt = isset($remainingAttempts) ? (int) $remainingAttempts : null;
    $nextLockMin = (int) ($nextLockMinutes ?? 3);
    $prefillIdent = old('nomor_induk', $lockSec > 0 ? $lockedUserIdent : '');
    $skipIntro = $errors->any() || old('nomor_induk') || $lockSec > 0 || ($remAtt !== null) || session('status') || session('open_forgot_modal');
@endphp
<body class="{{ $skipIntro ? '' : 'intro-active' }}">

    <!-- =========================================================
         SLIDE 1: DEEP NAVY UNM EDITORIAL OPENING (UNM + SI-SAPRAS)
         ========================================================= -->
    <section id="introStage" class="intro-stage {{ $skipIntro ? 'done' : '' }}" aria-label="Animasi Pembukaan SI-SAPRAS UNM" onclick="triggerSlideTwoNow()">

        <!-- 5 Vertical Staggered Architectural Columns -->
        <div class="curtain-columns" aria-hidden="true">
            <div class="curtain-col"></div>
            <div class="curtain-col"></div>
            <div class="curtain-col"></div>
            <div class="curtain-col"></div>
            <div class="curtain-col"></div>
        </div>

        <!-- Subtle Film Grain -->
        <div class="intro-grain" aria-hidden="true"></div>

        <!-- Giant Ghost Watermark Typography -->
        <div class="intro-ghost-wrap" aria-hidden="true">
            <div class="intro-ghost-text">UNM — JTIK</div>
        </div>

        <!-- Swiss Editorial Diagonal Frame -->
        <div class="editorial-frame" aria-hidden="true">
            <div class="corner-meta corner-tl"><span>JTIK &mdash; FT UNM</span></div>
            <div class="corner-meta corner-br"><span>Sarana &amp; Prasarana</span></div>
        </div>

        <!-- Centerpiece: ONLY UNM Emblem + Per-Character SI-SAPRAS JTIK -->
        <div class="intro-center">
            <div class="intro-lockup">
                <div class="intro-emblem-slot">
                    <img src="{{ asset('images/Logo Resmi UNM.png') }}"
                         alt="Logo Universitas Negeri Makassar"
                         class="intro-emblem-img"
                         onerror="this.src='{{ asset('images/logo-unm-white.png') }}'">
                </div>

                <div class="intro-divider-wrap" aria-hidden="true">
                    <div class="intro-divider-line"></div>
                </div>

                <div class="intro-wordmark-slot">
                    <div class="intro-wordmark-inner">
                        <div class="intro-title-row" aria-label="SI-SAPRAS JTIK">
                            <span class="word-group w-white">
                                <span class="char-item" style="--i:0">S</span><span class="char-item" style="--i:1">I</span><span class="char-item" style="--i:2">-</span><span class="char-item" style="--i:3">S</span><span class="char-item" style="--i:4">A</span><span class="char-item" style="--i:5">P</span><span class="char-item" style="--i:6">R</span><span class="char-item" style="--i:7">A</span><span class="char-item" style="--i:8">S</span>
                            </span>
                            <span class="word-group w-orange">
                                <span class="char-item" style="--i:9">J</span><span class="char-item" style="--i:10">T</span><span class="char-item" style="--i:11">I</span><span class="char-item" style="--i:12">K</span>
                            </span>
                        </div>
                        <div class="intro-sub-row">
                            <span class="intro-sub-accent" aria-hidden="true"></span>
                            <div class="intro-sub-mask">
                                <div class="intro-sub">Universitas Negeri Makassar</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================
         SLIDE 2: PORTAL LOGIN SI-SAPRAS JTIK FT UNM
         ========================================================= -->
    <div id="slideTwoShell" class="slide-two-shell {{ $skipIntro ? '' : 'waiting' }}">

        <!-- TOP NAVBAR -->
        <header class="top-navbar">
            <a href="{{ url('/') }}" class="nav-brand" onclick="replayIntroFromLogo(event)" title="Klik untuk memutar ulang animasi pembukaan">
                <img src="{{ asset('images/logo-unm-resmi-siakad.png') }}" alt="Logo UNM Resmi" class="nav-logo-unm">
                <img src="{{ asset('images/logo-blu-speed.png') }}" alt="Logo BLU Speed" class="nav-logo-blu">
                <div class="brand-text-col">
                    <div class="brand-title-row">
                        <span class="brand-main-navy">SI-SAPRAS</span>
                        <span class="brand-main-orange">JTIK</span>
                    </div>
                    <span class="brand-sub-name">Universitas Negeri Makassar</span>
                </div>
            </a>
            <a href="{{ route('staff.login') }}" class="nav-portal-link">Portal Petugas</a>
        </header>

        <!-- HERO SECTION -->
        <main class="hero-section">
            <div class="hero-photo-layer"></div>

            <div class="hero-container">

                <!-- SISI KIRI -->
                <div class="hero-left">
                    <div class="welcome-pill">
                        Selamat Datang di SI-SAPRAS JTIK
                    </div>

                    <h1 class="hero-headline">
                        <span class="headline-line-mask"><span class="headline-line-text headline-line-1">Semua urusan sarpras,</span></span>
                        <span class="headline-line-mask"><span class="headline-line-text headline-line-2">dalam satu pintu.</span></span>
                    </h1>

                    <p class="hero-description">
                        Peminjaman alat laboratorium dan bengkel, pemantauan ketersediaan inventaris praktikum, hingga pengurusan surat bebas sarpras — terhubung dalam Sistem Informasi Sarana &amp; Prasarana Terintegrasi Jurusan Teknik Informatika dan Komputer FT UNM.
                    </p>

                    <div class="benefit-badges">
                        <div class="benefit-badge">
                            <span class="check-circle">✓</span>
                            <span>Inventaris Lab &amp; Ruangan</span>
                        </div>
                        <div class="benefit-badge">
                            <span class="check-circle">✓</span>
                            <span>Monitoring Real-time</span>
                        </div>
                        <div class="benefit-badge">
                            <span class="check-circle">✓</span>
                            <span>Bebas Sarpras Digital</span>
                        </div>
                    </div>
                </div>

                <!-- SISI KANAN: FORM LOGIN -->
                <div class="hero-right">
                    <div class="siakad-card">

                        <div class="card-brand-header">
                            <h2 class="card-title-navy">Masuk Akun Mahasiswa</h2>
                            <p class="card-subtitle-muted">Gunakan NIM dan kata sandi akun terdaftar Anda</p>
                        </div>

                        @if(session('status'))
                            <div class="alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($lockSec > 0)
                            <div class="alert-error" id="loginLockoutAlert">
                                Percobaan masuk gagal sudah mencapai <strong>{{ $lockAtt }} kali</strong>. Silakan tunggu <strong id="lockoutCountdown">{{ sprintf('%02d:%02d', intdiv($lockSec, 60), $lockSec % 60) }}</strong> ({{ $lockStageMin }} menit) sebelum mencoba kembali.@if($mailAlertSent) Pemberitahuan keamanan telah dikirim otomatis ke email pemilik akun.@endif
                            </div>
                        @elseif($errors->has('login_error'))
                            <div class="alert-error">
                                {{ $errors->first('login_error') }}
                                @if(session('redirect_staff_portal'))
                                    <div style="margin-top: 8px;">
                                        <a href="{{ route('staff.login') }}" style="color:#092552; font-weight:700; text-decoration:underline;">Buka Portal Pengelola &amp; Admin &rarr;</a>
                                    </div>
                                @endif
                            </div>
                        @elseif($remAtt !== null && $remAtt > 0)
                            <div class="alert-warning">
                                Peringatan: Sisa <strong>{{ $remAtt }}</strong> percobaan lagi sebelum akses ditahan sementara <strong>{{ $nextLockMin }} menit</strong>{{ $nextLockMin >= 5 ? ' dan dikirim notifikasi ke email' : '' }}.
                            </div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                            @csrf

                            <div class="form-group">
                                <div class="label-row">
                                    <span class="label-main">NIM Mahasiswa:</span>
                                    <span class="label-hint">Akun terdaftar</span>
                                </div>
                                <input
                                    type="text"
                                    name="nomor_induk"
                                    id="nomor_induk"
                                    class="form-input"
                                    placeholder="Contoh: 250210500034"
                                    value="{{ $prefillIdent }}"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <div class="label-row">
                                    <span class="label-main">Kata Sandi:</span>
                                    <span class="label-hint">6–32 karakter</span>
                                </div>
                                <div class="password-wrap">
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-input"
                                        minlength="6"
                                        maxlength="32"
                                        placeholder="Masukkan kata sandi..."
                                        required
                                    >
                                    <button type="button" class="toggle-btn" onclick="togglePass()" title="Tampilkan / Sembunyikan Kata Sandi">
                                        <svg id="eyeOpenIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        <svg id="eyeClosedIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                            <line x1="1" y1="1" x2="23" y2="23"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="options-row">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Ingat saya di perangkat ini
                                </label>
                                <a href="javascript:void(0)" onclick="openModal()">Lupa sandi?</a>
                            </div>

                            <button type="submit" id="btnLoginSubmit" class="btn-submit-main" style="margin-bottom: 4px;" {{ $lockSec > 0 ? 'disabled' : '' }}>
                                {{ $lockSec > 0 ? 'Coba lagi dalam ' . sprintf('%02d:%02d', intdiv($lockSec, 60), $lockSec % 60) : 'Masuk Portal Mahasiswa' }}
                            </button>
                            <p style="margin-top: 10px; font-size: 11px; color: #64748b; line-height: 1.45;">
                                Keamanan: salah 3x ditahan 3 menit, salah 5x ditahan 5 menit dan diberitahu via email.
                            </p>
                        </form>

                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- MODAL LUPA KATA SANDI (KONFIRMASI LANGSUNG KE EMAIL PEMILIK AKUN) -->
    <div id="modalLupa" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header-row">
                <span class="modal-title-text">Pemulihan Kata Sandi via Email</span>
                <button type="button" class="modal-close-btn" onclick="closeModal()">&times;</button>
            </div>
            <p style="font-size: 12.5px; color: #334155; line-height: 1.55; margin-bottom: 12px;">
                Masukkan <strong>NIM</strong> atau <strong>Email akun mahasiswa</strong> Anda. Sistem akan mengirim tautan persetujuan (ACC) atur ulang kata sandi langsung ke email pemilik akun.
            </p>
            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:10px 12px; font-size:11.5px; color:#475569; line-height:1.5; margin-bottom:14px;">
                Demi privasi keamanan akun, Admin tidak dapat mengakses maupun mengatur ulang kata sandi pengguna.
            </div>

            @if($errors->has('forgot_error'))
                <div class="alert-error" style="margin-bottom:12px;">
                    {{ $errors->first('forgot_error') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <input type="text" name="identity" class="form-input" placeholder="Masukkan NIM atau Email akun..." value="{{ old('identity') }}" required style="margin-bottom: 12px;">
                <button type="submit" class="btn-submit-main" style="padding: 11px;">
                    Kirim Konfirmasi ke Email Saya
                </button>
            </form>
        </div>
    </div>

    <script>
        const skipIntro = @json((bool) $skipIntro);
        let introTimers = [];
        let isLifting = false;

        function clearIntroTimers() {
            introTimers.forEach((id) => clearTimeout(id));
            introTimers = [];
        }

        function runOpeningSequence() {
            clearIntroTimers();
            isLifting = false;

            const stage = document.getElementById('introStage');
            const slideTwo = document.getElementById('slideTwoShell');

            document.body.classList.add('intro-active');
            stage.classList.remove('playing', 'to-slide-two', 'exit-content', 'lifting', 'done');
            slideTwo.classList.remove('revealed');
            slideTwo.classList.add('waiting');

            // Force DOM reflow untuk mereset semua keyframe & animasi per-huruf
            void stage.offsetWidth;

            stage.classList.add('playing');

            // Beat 3.5: Indikator 01 -> 02 bergulir sesaat sebelum tirai terangkat
            introTimers.push(setTimeout(() => {
                stage.classList.add('to-slide-two');
            }, 2350));

            // Beat 4: 5 Kolom Tirai terangkat bergelombang menyingkap Slide 2
            introTimers.push(setTimeout(() => {
                triggerSlideTwoNow();
            }, 2680));
        }

        function triggerSlideTwoNow() {
            if (isLifting) return;
            isLifting = true;
            clearIntroTimers();

            const stage = document.getElementById('introStage');
            const slideTwo = document.getElementById('slideTwoShell');

            stage.classList.add('to-slide-two', 'exit-content');

            introTimers.push(setTimeout(() => {
                stage.classList.add('lifting');
                slideTwo.classList.add('revealed');
            }, 200));

            introTimers.push(setTimeout(() => {
                stage.classList.add('done');
                slideTwo.classList.remove('waiting');
                document.body.classList.remove('intro-active');
            }, 1500));
        }

        function replayIntroFromLogo(event) {
            if (event) event.preventDefault();
            runOpeningSequence();
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (!skipIntro) {
                runOpeningSequence();
            }
        });

        // Tekan 'R' (di luar kolom input) untuk memutar ulang animasi saat presentasi
        document.addEventListener('keydown', (e) => {
            const tag = (e.target && e.target.tagName) ? e.target.tagName.toLowerCase() : '';
            if (tag === 'input' || tag === 'textarea') return;
            if (e.key.toLowerCase() === 'r' && !e.ctrlKey && !e.metaKey) {
                runOpeningSequence();
            }
        });

        function togglePass() {
            const pass = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpenIcon');
            const eyeClosed = document.getElementById('eyeClosedIcon');

            if (pass.type === 'password') {
                pass.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                pass.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }

        function openModal() {
            document.getElementById('modalLupa').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modalLupa').style.display = 'none';
        }

        @if(session('open_forgot_modal') || $errors->has('forgot_error'))
            document.addEventListener('DOMContentLoaded', function() {
                openModal();
            });
        @endif

        (function initLoginLockoutCountdown() {
            let remainingSeconds = {{ (int) ($lockoutSeconds ?? 0) }};
            const lockStageMinutes = {{ (int) ($lockoutStageMinutes ?? 3) }};
            const lockedIdent = (@json($lockedIdent ?? '') || '').toLowerCase();
            const submitBtn = document.getElementById('btnLoginSubmit');
            const identInput = document.getElementById('nomor_induk');
            const countdownEl = document.getElementById('lockoutCountdown');
            const alertEl = document.getElementById('loginLockoutAlert');

            if (!submitBtn || remainingSeconds <= 0) return;

            function fmt(sec) {
                const m = Math.floor(sec / 60);
                const s = sec % 60;
                return String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
            }

            function syncLockUi() {
                const currentIdent = (identInput ? identInput.value : '').trim().toLowerCase();
                const isSameLockedAccount = !lockedIdent || currentIdent === lockedIdent;

                if (remainingSeconds <= 0) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Masuk Portal Mahasiswa';
                    if (alertEl) {
                        alertEl.style.background = '#eff6ff';
                        alertEl.style.color = '#1e3a8a';
                        alertEl.style.borderColor = '#bfdbfe';
                        alertEl.textContent = 'Waktu tunggu ' + lockStageMinutes + ' menit selesai. Silakan coba masuk kembali.';
                    }
                    return;
                }

                if (countdownEl) {
                    countdownEl.textContent = fmt(remainingSeconds);
                }

                if (isSameLockedAccount) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Coba lagi dalam ' + fmt(remainingSeconds);
                } else {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Masuk Portal Mahasiswa';
                }
            }

            if (identInput) {
                identInput.addEventListener('input', syncLockUi);
            }

            syncLockUi();
            const timer = setInterval(function() {
                remainingSeconds = Math.max(0, remainingSeconds - 1);
                syncLockUi();
                if (remainingSeconds <= 0) {
                    clearInterval(timer);
                }
            }, 1000);
        })();
    </script>

    @include('partials.ui_feedback')
</body>
</html>
