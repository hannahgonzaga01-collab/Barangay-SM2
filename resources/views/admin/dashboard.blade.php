<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard — Barangay SM2</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --brand: #0E5393;
            --brand-dark: #04192D;
            --brand-darker: #000052;
            --body-bg: #f1f5f9;
            --border: #e2e8f0;
            --text: #0f172a;
            --muted: #64748b;
            --light: #94a3b8;
            --card-shadow: 0 4px 24px rgba(4, 25, 45, 0.10), 0 1.5px 6px rgba(0, 0, 0, 0.05);
            --btn-grad: linear-gradient(135deg, #0E5393 0%, #04192D 100%);
            --r: 14px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--body-bg);
            min-height: 100vh;
        }

        [x-cloak] {
            display: none !important;
        }

        /* TOPBAR */
        .topbar {
            background: linear-gradient(135deg, #000052 0%, #04192D 60%, #0E5393 100%);
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 200;
            box-shadow: 0 2px 20px rgba(0, 0, 52, .45);
        }

        .tb-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .tb-logo {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, .3);
        }

        .tb-name {
            font-size: 13px;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .tb-sub {
            font-size: 9px;
            color: rgba(255, 255, 255, .5);
            font-weight: 600;
            text-transform: uppercase;
        }

        .tb-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 800;
            color: rgba(255, 255, 255, .8);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: .04em;
            transition: all .15s;
            cursor: pointer;
            background: none;
            border: none;
            font-family: inherit;
            white-space: nowrap;
        }

        .tb-btn:hover,
        .tb-btn.is-active {
            background: rgba(255, 255, 255, .18);
            color: #fff;
        }

        .tb-btn i {
            font-size: 11px;
        }

        .tb-dropdown {
            position: relative;
        }

        .tb-drop-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            min-width: 210px;
            background: #fff;
            border-radius: 13px;
            box-shadow: 0 8px 32px rgba(0, 0, 52, .18);
            border: 1px solid #e2e8f0;
            z-index: 300;
            overflow: hidden;
        }

        .tb-drop-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 15px;
            font-size: 11px;
            font-weight: 700;
            color: #0f172a;
            text-decoration: none;
            transition: all .1s;
            border-bottom: 1px solid #f1f5f9;
        }

        .tb-drop-item:last-child {
            border-bottom: none;
        }

        .tb-drop-item:hover {
            background: #eff6ff;
            color: #0E5393;
        }

        .tb-drop-item i {
            width: 16px;
            text-align: center;
            color: #0E5393;
        }

        .tb-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tb-user {
            font-size: 10px;
            font-weight: 700;
            color: rgba(255, 255, 255, .65);
        }

        .tb-logout {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 800;
            color: rgba(255, 255, 255, .7);
            text-transform: uppercase;
            background: rgba(220, 38, 38, .2);
            border: 1px solid rgba(220, 38, 38, .3);
            cursor: pointer;
            font-family: inherit;
            transition: all .15s;
        }

        .tb-logout:hover {
            background: rgba(220, 38, 38, .5);
            color: #fff;
        }

        /* Hamburger mobile menu */
        .tb-hamburger {
            display: none;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, .12);
            border: 1.5px solid rgba(255, 255, 255, .25);
            border-radius: 9px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: all .15s;
            flex-shrink: 0;
        }

        .tb-hamburger:hover {
            background: rgba(255, 255, 255, .22);
        }

        .mobile-menu-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 490;
            backdrop-filter: blur(3px);
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: 280px;
            background: linear-gradient(160deg, #000052 0%, #04192D 60%, #0E5393 100%);
            z-index: 500;
            padding: 0;
            overflow-y: auto;
            box-shadow: -10px 0 40px rgba(0, 0, 52, .5);
            display: flex;
            flex-direction: column;
        }

        .mob-menu-head {
            padding: 18px 20px 14px;
            border-bottom: 1px solid rgba(255, 255, 255, .12);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .mob-menu-title {
            font-size: 12px;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .mob-close-btn {
            background: rgba(255, 255, 255, .12);
            border: none;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
        }

        .mob-section-lbl {
            font-size: 9px;
            font-weight: 900;
            color: rgba(255, 255, 255, .4);
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: 14px 20px 6px;
        }

        .mob-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            font-size: 12px;
            font-weight: 700;
            color: rgba(255, 255, 255, .85);
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
            transition: all .12s;
            cursor: pointer;
            background: none;
            border-left: 3px solid transparent;
            font-family: inherit;
            text-align: left;
            width: 100%;
        }

        .mob-item:hover,
        .mob-item.active {
            background: rgba(255, 255, 255, .1);
            color: #fff;
            border-left-color: rgba(255, 255, 255, .5);
        }

        .mob-item i {
            width: 18px;
            text-align: center;
            font-size: 13px;
            color: rgba(255, 255, 255, .6);
        }

        .mob-item:hover i,
        .mob-item.active i {
            color: #fff;
        }

        .mob-footer {
            padding: 18px 20px;
            border-top: 1px solid rgba(255, 255, 255, .12);
            margin-top: auto;
        }

        /* WRAP */
        .dash-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 22px 20px 48px;
        }

        /* GREETING */
        .greeting {
            background: linear-gradient(135deg, #000052 0%, #04192D 55%, #0E5393 100%);
            border-radius: var(--r);
            padding: 22px 26px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            box-shadow: var(--card-shadow);
        }

        .greeting h1 {
            font-size: 20px;
            font-weight: 900;
            color: #fff;
        }

        .greeting p {
            font-size: 11px;
            color: rgba(255, 255, 255, .55);
            font-weight: 600;
            margin-top: 3px;
        }

        .g-stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .gs {
            text-align: center;
        }

        .gs-n {
            font-size: 24px;
            font-weight: 900;
            color: #fff;
            line-height: 1;
        }

        .gs-l {
            font-size: 8px;
            font-weight: 700;
            color: rgba(255, 255, 255, .5);
            text-transform: uppercase;
            letter-spacing: .07em;
            margin-top: 2px;
        }

        /* TABS */
        .tab-bar {
            display: flex;
            gap: 5px;
            background: #fff;
            padding: 5px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 22px;
            border: 1px solid var(--border);
            flex-wrap: wrap;
        }

        .tab-btn {
            flex: 1;
            min-width: 90px;
            padding: 9px 12px;
            border-radius: 9px;
            border: none;
            background: transparent;
            font-family: inherit;
            font-size: 10px;
            font-weight: 800;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .05em;
            cursor: pointer;
            transition: all .18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .tab-btn.active {
            background: var(--btn-grad);
            color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 82, .25);
        }

        .tab-btn:not(.active):hover {
            background: #f8fafc;
            color: var(--text);
        }

        .tcnt {
            font-size: 9px;
            padding: 1px 6px;
            border-radius: 99px;
            background: rgba(14, 83, 147, .1);
            color: var(--brand);
        }

        .tab-btn.active .tcnt {
            background: rgba(255, 255, 255, .2);
            color: #fff;
        }

        .tcnt-red {
            background: rgba(220, 38, 38, .15);
            color: #dc2626;
        }

        .tab-btn.active .tcnt-red {
            background: rgba(255, 255, 255, .2);
            color: #fff;
        }

        /* CARDS */
        .card {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(4, 25, 45, .05);
            overflow: hidden;
            margin-bottom: 18px;
        }

        .card-head {
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }

        .card-title {
            font-size: 10px;
            font-weight: 900;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: .09em;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .card-title i {
            color: var(--brand);
        }

        .cbadge {
            font-size: 9px;
            background: #eff6ff;
            color: var(--brand);
            font-weight: 900;
            padding: 3px 9px;
            border-radius: 99px;
        }

        .cbadge-red {
            background: #fee2e2;
            color: #dc2626;
        }

        .cbadge-green {
            background: #dcfce7;
            color: #15803d;
        }

        /* STAT GRID */
        .sg {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }

        .sc {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1px solid rgba(4, 25, 45, .04);
        }

        .sc-ico {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sc-ico i {
            font-size: 18px;
        }

        .sc-n {
            font-size: 26px;
            font-weight: 900;
            color: var(--text);
            line-height: 1;
        }

        .sc-l {
            font-size: 9px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-top: 2px;
        }

        /* CHART GRID */
        .chart-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 18px;
        }

        .chart-box {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            padding: 20px;
            border: 1px solid rgba(4, 25, 45, .04);
        }

        .chart-title {
            font-size: 10px;
            font-weight: 900;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: .09em;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .chart-title i {
            color: var(--brand);
        }

        /* DEMO CARDS */
        .demo-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }

        .dmcard {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            padding: 14px 16px;
            border: 1px solid rgba(4, 25, 45, .04);
        }

        .dm-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 9px;
        }

        .dm-ico {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dm-ico i {
            font-size: 14px;
        }

        .dm-n {
            font-size: 26px;
            font-weight: 900;
            color: var(--text);
            line-height: 1;
        }

        .dm-l {
            font-size: 9px;
            font-weight: 800;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 8px;
        }

        .bar-bg {
            height: 6px;
            background: #f1f5f9;
            border-radius: 99px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 99px;
        }

        .bar-pct {
            font-size: 9px;
            font-weight: 700;
            color: var(--muted);
            margin-top: 4px;
            text-align: right;
        }

        /* GENDER */
        .gender-wrap {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            padding: 18px;
            margin-bottom: 18px;
            border: 1px solid rgba(4, 25, 45, .04);
        }

        .gbar {
            height: 22px;
            border-radius: 99px;
            overflow: hidden;
            display: flex;
            margin: 12px 0 8px;
        }

        .gbar-m {
            background: linear-gradient(90deg, #000052, #0E5393);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 900;
            color: #fff;
        }

        .gbar-f {
            background: linear-gradient(90deg, #be185d, #ec4899);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 900;
            color: #fff;
        }

        .glegend {
            display: flex;
            gap: 18px;
        }

        .gl {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
        }

        .gldot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
        }

        /* OFFICIALS */
        .off-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            padding: 16px;
        }

        .off-card {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            text-align: center;
        }

        .off-photo-wrap {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 10px;
            border: 3px solid var(--brand);
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
            background: #e2e8f0;
            flex-shrink: 0;
        }

        .off-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            display: block;
        }

        .off-name {
            font-size: 12px;
            font-weight: 900;
            color: var(--text);
            line-height: 1.3;
        }

        .off-pos {
            font-size: 9px;
            font-weight: 700;
            color: var(--brand);
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-top: 3px;
        }

        .off-term {
            font-size: 9px;
            color: var(--muted);
            font-weight: 600;
            margin-top: 4px;
        }

        .off-acts {
            display: flex;
            gap: 5px;
            justify-content: center;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        /* ANN & EVENT ITEMS */
        .ann-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 13px 18px;
            border-bottom: 1px solid #f8fafc;
        }

        .ann-item:last-child {
            border-bottom: none;
        }

        .ann-tag {
            font-size: 8px;
            font-weight: 900;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 99px;
            display: inline-block;
            margin-bottom: 4px;
        }

        .ann-title {
            font-size: 13px;
            font-weight: 800;
            color: var(--text);
        }

        .ann-body {
            font-size: 11px;
            color: var(--muted);
            font-weight: 600;
            margin-top: 3px;
            line-height: 1.5;
        }

        .ann-date {
            font-size: 9px;
            color: var(--light);
            font-weight: 600;
            margin-top: 5px;
        }

        .ann-actions {
            display: flex;
            gap: 5px;
            flex-shrink: 0;
        }

        .evt-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 13px 18px;
            border-bottom: 1px solid #f8fafc;
        }

        .evt-item:last-child {
            border-bottom: none;
        }

        .evt-day {
            background: var(--btn-grad);
            color: #fff;
            border-radius: 10px;
            width: 42px;
            height: 42px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .evt-day-num {
            font-size: 13px;
            font-weight: 900;
            line-height: 1;
        }

        .evt-day-sm {
            font-size: 7px;
            font-weight: 700;
            text-transform: uppercase;
            opacity: .8;
        }

        /* MESSAGES */
        .msg-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            transition: background .1s;
            cursor: pointer;
        }

        .msg-item:last-child {
            border-bottom: none;
        }

        .msg-item:hover {
            background: #f8fafc;
        }

        .msg-item.unread {
            background: #eff6ff;
        }

        .msg-item.unread:hover {
            background: #dbeafe;
        }

        .msg-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
            font-size: 13px;
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: var(--btn-grad);
        }

        .msg-sender {
            font-size: 13px;
            font-weight: 900;
            color: var(--text);
        }

        .msg-subject {
            font-size: 12px;
            font-weight: 800;
            color: var(--brand);
            margin-top: 2px;
        }

        .msg-preview {
            font-size: 11px;
            color: var(--muted);
            font-weight: 600;
            margin-top: 3px;
            line-height: 1.4;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 600px;
        }

        .msg-time {
            font-size: 10px;
            color: var(--light);
            font-weight: 600;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .msg-unread-dot {
            width: 9px;
            height: 9px;
            background: #0E5393;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 5px;
        }

        .msg-detail-box {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            margin: 0 20px 16px;
        }

        .msg-reply-bar {
            background: #f8fafc;
            border-top: 2px solid var(--border);
            padding: 16px 20px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        /* REPORT */
        .report-section {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            padding: 28px 32px;
            margin-bottom: 18px;
            border: 1px solid rgba(4, 25, 45, .04);
        }

        @media print {
            @page { margin: 0.5in; }

            .topbar,
            .tab-bar,
            .no-print {
                display: none !important;
            }

            body {
                background: #fff;
            }

            .report-section {
                box-shadow: none;
                border: none;
                padding: 0;
                margin: 0;
            }

            .dash-wrap {
                padding: 0;
                margin: 0;
            }

            .greeting {
                display: none;
            }
        }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            font-family: inherit;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .05em;
            text-transform: uppercase;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            transition: all .18s;
            white-space: nowrap;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--btn-grad);
            color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 82, .28);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(0, 0, 82, .38);
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 9px;
        }

        .btn-warn {
            background: linear-gradient(135deg, #d97706, #92400e);
            color: #fff;
        }

        .btn-success {
            background: linear-gradient(135deg, #059669, #064e3b);
            color: #fff;
        }

        .btn-ghost {
            background: #f1f5f9;
            color: #475569;
            box-shadow: none;
        }

        .btn-ghost:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626, #7f1d1d);
            color: #fff;
        }

        .btn-edit {
            background: #eff6ff;
            color: var(--brand);
            box-shadow: none;
        }

        .btn-edit:hover {
            background: var(--brand);
            color: #fff;
        }

        /* FORMS */
        .flbl {
            font-size: 9px;
            font-weight: 800;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .06em;
            display: block;
            margin-bottom: 4px;
        }

        .finput {
            width: 100%;
            padding: 9px 12px;
            background: #f8fafc;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
            outline: none;
            transition: border-color .15s;
        }

        .finput:focus {
            border-color: var(--brand);
            background: #fff;
        }

        .finput::placeholder {
            color: var(--light);
            font-weight: 500;
        }

        .fgrid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .fgrid3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
        }

        .fgrp {
            margin-bottom: 12px;
        }

        .fselect {
            appearance: none;
            cursor: pointer;
        }

        /* MODAL */
        .modal-ov {
            position: fixed;
            inset: 0;
            z-index: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 14px;
            background: rgba(0, 0, 18, .65);
            backdrop-filter: blur(5px);
        }

        .modal-box {
            background: #fff;
            width: 100%;
            max-width: 540px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 52, .35);
            border-bottom: 5px solid var(--brand);
            max-height: 92vh;
            overflow-y: auto;
        }

        .modal-in {
            padding: 22px;
        }

        .modal-hd {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border);
        }

        .modal-ttl {
            font-size: 13px;
            font-weight: 900;
            color: var(--text);
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mico {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mico i {
            color: var(--brand);
            font-size: 12px;
        }

        .mclose {
            background: none;
            border: none;
            color: var(--light);
            font-size: 19px;
            cursor: pointer;
        }

        .mclose:hover {
            color: #dc2626;
        }

        /* TOAST */
        .toast {
            position: fixed;
            top: 16px;
            right: 16px;
            z-index: 9999;
            background: #059669;
            color: #fff;
            padding: 11px 18px;
            border-radius: 11px;
            box-shadow: var(--card-shadow);
            font-weight: 800;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        /* EMPTY */
        .empty-st {
            padding: 36px;
            text-align: center;
            color: var(--light);
        }

        .empty-st i {
            font-size: 28px;
            display: block;
            margin-bottom: 8px;
            opacity: .2;
        }

        .empty-st p {
            font-size: 11px;
            font-weight: 700;
        }

        @media(max-width:1024px) {
            .sg {
                grid-template-columns: repeat(2, 1fr);
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }

            .demo-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .off-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media(max-width:768px) {
            .tb-hamburger {
                display: flex;
                margin-left: auto;
            }

            .tb-left .tb-dropdown,
            .tb-right {
                display: none !important;
            }

            .dash-wrap {
                padding: 14px 12px 32px;
            }

            .sg {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .demo-grid {
                grid-template-columns: 1fr 1fr;
            }

            .off-grid {
                grid-template-columns: 1fr 1fr;
            }

            .g-stats {
                gap: 12px;
            }

            .greeting h1 {
                font-size: 16px;
            }

            .tab-btn span {
                display: none;
            }

            .tab-bar {
                gap: 3px;
            }

            .tab-btn {
                min-width: 40px;
                padding: 8px 6px;
            }

            .msg-preview {
                max-width: 200px;
            }
        }

        @media(max-width:480px) {
            .sg {
                grid-template-columns: 1fr 1fr;
            }

            .demo-grid {
                grid-template-columns: 1fr 1fr;
            }

            .off-grid {
                grid-template-columns: 1fr 1fr;
            }

            .fgrid2,
            .fgrid3 {
                grid-template-columns: 1fr;
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    @if(session('success'))
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,3500)"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="toast">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <script>
        window._adminMessages = @json($residentMessages ?? []);
        window._officials = @json($officials ?? []);
        window._announcements = @json($announcements ?? []);
        window._events = @json($events ?? []);
        window._residents = @json($resList ?? []);
    </script>

    <div x-data="{
    tab: 'overview',
    portalsOpen: false,
    annOpen: false,
    evtOpen: false,
    offOpen: false,
    mobileMenuOpen: false,
    addAnnModal: false,
    annPhotoPreview: null,
    editAnnModal: false,
    editAnn: {},
    editAnnPhotoPreview: null,
    addEvtModal: false,
    evtPhotoPreview: null,
    editEvtModal: false,
    editEvt: {},
    editEvtPhotoPreview: null,
    addOffModal: false,
    photoPreview: null,
    editOffModal: false,
    editOff: {},
    editOffPhotoPreview: null,
    reportType: 'full',
    lguSyncModal: false,

    /* GLOBAL SEARCH */
    globalSearchInput: '',
    showGlobalResults: false,
    globalSearchResults: [],

    /* FILTERS */
    filterMonth: '',
    filterDept: '',
    showFilters: false,

    /* VIEW FILTERS */
    offViewMode: 'grid',
    searchOff: '',
    searchAnn: '',
    searchEvt: '',

    /* MESSAGES */
    selectedMsg: null,
    replyText: '',
    replySending: false,
    replySent: false,
    msgFilter: 'all',

    openMsg(msg) {
        this.selectedMsg = msg;
        this.replyText = '';
        this.replySent = false;
        /* Mark as read via AJAX */
        if (!msg.read_at) {
            fetch('/admin/messages/' + msg.id + '/read', {
                method: 'PATCH',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
            }).then(() => {
                msg.read_at = true;
                const idx = this.allMsgs.findIndex(m => m.id === msg.id);
                if (idx !== -1) this.allMsgs[idx].read_at = true;
            });
        }
    },

    sendReply() {
        if (!this.replyText || !this.selectedMsg) return;
        this.replySending = true;
        fetch('/admin/messages/' + this.selectedMsg.id + '/reply', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ reply: this.replyText })
        }).then(r => r.json()).then((data) => {
            this.replySending = false;
            this.replySent = true;
            if (this.selectedMsg) {
                this.selectedMsg.admin_reply = this.replyText;
                this.selectedMsg.replied_at = data.replied_at || true;
                // Also update in allMsgs array
                const idx = this.allMsgs.findIndex(m => m.id === this.selectedMsg.id);
                if (idx !== -1) {
                    this.allMsgs[idx].admin_reply = this.selectedMsg.admin_reply;
                    this.allMsgs[idx].replied_at = this.selectedMsg.replied_at;
                }
            }
            this.replyText = '';
        }).catch(() => { this.replySending = false; });
    },

    allMsgs: [],

    get filteredMessages() {
        if (this.msgFilter === 'unread') return this.allMsgs.filter(m => !m.read_at);
        if (this.msgFilter === 'read') return this.allMsgs.filter(m => m.read_at);
        return this.allMsgs;
    },

    get unreadCount() {
        return this.allMsgs.filter(m => !m.read_at).length;
    },

    performGlobalSearch() {
        const q = this.globalSearchInput.toLowerCase().trim();
        if (!q) {
            this.showGlobalResults = false;
            return;
        }

        let results = [];

        // Search officials
        if(window._officials) {
            window._officials.forEach(o => {
                if((o.name + ' ' + (o.position||'')).toLowerCase().includes(q)) {
                    results.push({ type: 'Official', id: o.id, title: o.name, subtitle: o.position||'', icon: 'fas fa-user-tie', tab: 'officials', searchVar: 'searchOff' });
                }
            });
        }

        // Search announcements
        if(window._announcements) {
            window._announcements.forEach(a => {
                let textContent = a.content ? a.content.replace(/(<([^>]+)>)/gi, '') : '';
                if((a.title + ' ' + textContent).toLowerCase().includes(q)) {
                    results.push({ type: 'Announcement', id: a.id, title: a.title, subtitle: textContent.substring(0,60)+'...', icon: 'fas fa-bullhorn', tab: 'announcements', searchVar: 'searchAnn' });
                }
            });
        }

        // Search events
        if(window._events) {
            window._events.forEach(e => {
                let loc = e.location || '';
                if((e.title + ' ' + loc + ' ' + (e.description||'')).toLowerCase().includes(q)) {
                    results.push({ type: 'Event', id: e.id, title: e.title, subtitle: e.day_label + (loc ? (' • ' + loc) : ''), icon: 'fas fa-calendar-alt', tab: 'events', searchVar: 'searchEvt' });
                }
            });
        }

        // Search messages
        this.allMsgs.forEach(m => {
            if((m.subject + ' ' + (m.name||'')).toLowerCase().includes(q)) {
                results.push({ type: 'Message', id: m.id, title: m.subject, subtitle: 'From: ' + (m.name||'Anonymous'), icon: 'fas fa-envelope', tab: 'messages', searchVar: '' });
            }
        });

        this.globalSearchResults = results.slice(0, 15);
        this.showGlobalResults = true;
    },

    goToResult(res) {
        this.tab = res.tab;
        this.showGlobalResults = false;
        this.globalSearchInput = '';
        if(res.searchVar) {
            this[res.searchVar] = res.title;
        } else if (res.tab === 'messages') {
            const msg = this.allMsgs.find(m => m.id === res.id);
            if(msg) this.openMsg(msg);
        }
    },

    applyFilters() {
        if (!this.filterMonth) {
            this.showGlobalResults = false;
            return;
        }
        let results = [];
        if (window._residents) {
            window._residents.forEach(r => {
                if(r.bmonth == this.filterMonth) {
                    results.push({ type: 'Resident (Bday)', id: r.id, title: r.name, subtitle: 'Born: ' + (r.bdate_raw ? new Date(r.bdate_raw).toLocaleDateString() : 'Unknown'), icon: 'fas fa-birthday-cake', tab: 'demographics', searchVar: '' });
                }
            });
        }

        if (results.length === 0) {
            this.globalSearchInput = 'Birthday Filter';
        } else {
            this.globalSearchInput = '';
        }

        this.globalSearchResults = results.slice(0, 50); // Show max 50 hits
        this.showGlobalResults = true;
        this.showFilters = false;
    },

    init() {
        this.allMsgs = window._adminMessages || [];
    }
}">

        {{-- ══ TOPBAR ══ --}}
        <div class="topbar">
            <div class="tb-left">
                <img src="{{ asset('images/circlelogo.png') }}" class="tb-logo" onerror="this.style.display='none'">
                <div>
                    <div class="tb-name">Admin Dashboard</div>
                    <div class="tb-sub">Barangay San Miguel II</div>
                </div>
                {{-- Portals sits right beside the title on desktop --}}
                <div class="tb-dropdown" @click.away="portalsOpen=false" style="margin-left:4px;">
                    <button class="tb-btn" @click="portalsOpen=!portalsOpen">
                        <i class="fas fa-th-large"></i> Portals
                        <i class="fas fa-chevron-down" style="font-size:8px;"
                            :style="portalsOpen?'transform:rotate(180deg);transition:.2s':''"></i>
                    </button>
                    <div x-show="portalsOpen" x-cloak x-transition class="tb-drop-menu">
                        <a href="/office" class="tb-drop-item"><i class="fas fa-users-cog"></i> Office Portal</a>
                        <a href="/justice" class="tb-drop-item"><i class="fas fa-gavel"></i> Justice Portal</a>
                        <a href="/vawc" class="tb-drop-item"><i class="fas fa-shield-alt"></i> VAWC Portal</a>
                        <a href="/peace" class="tb-drop-item"><i class="fas fa-shield"></i> Peace & Order</a>
                        <a href="/resident" class="tb-drop-item" target="_blank"><i class="fas fa-globe"></i> Public
                            View</a>
                    </div>
                </div>
            </div>

            {{-- Mobile: Hamburger --}}
            <button class="tb-hamburger" @click="mobileMenuOpen=true">
                <i class="fas fa-bars"></i>
            </button>

            <div class="tb-right">
                <span class="tb-user">{{ Auth::user()->first_name ?? Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="tb-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>

        {{-- ══ MOBILE SIDE MENU ══ --}}
        <div x-show="mobileMenuOpen" x-cloak>
            {{-- Backdrop --}}
            <div class="mobile-menu-overlay" @click="mobileMenuOpen=false"></div>
            {{-- Slide-in panel --}}
            <div class="mobile-menu" x-transition:enter="transition ease-out duration-250"
                x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                x-transition:leave-end="transform translate-x-full">
                <div class="mob-menu-head">
                    <span class="mob-menu-title"><i class="fas fa-th-large"
                            style="margin-right:7px;"></i>Navigation</span>
                    <button class="mob-close-btn" @click="mobileMenuOpen=false"><i class="fas fa-times"></i></button>
                </div>
                <div class="mob-section-lbl">Portals</div>
                <a href="/office" class="mob-item"><i class="fas fa-users-cog"></i> Office Portal</a>
                <a href="/justice" class="mob-item"><i class="fas fa-gavel"></i> Justice Portal</a>
                <a href="/vawc" class="mob-item"><i class="fas fa-shield-alt"></i> VAWC Portal</a>
                <a href="/peace" class="mob-item"><i class="fas fa-shield"></i> Peace & Order</a>
                <a href="/resident" class="mob-item" target="_blank"><i class="fas fa-globe"></i> Public View</a>
                <div class="mob-section-lbl">Dashboard</div>
                <button class="mob-item" :class="tab==='overview'?'active':''"
                    @click="tab='overview';mobileMenuOpen=false"><i class="fas fa-chart-pie"></i> Overview</button>
                <button class="mob-item" :class="tab==='demographics'?'active':''"
                    @click="tab='demographics';mobileMenuOpen=false"><i class="fas fa-users"></i> Demographics</button>
                <button class="mob-item" :class="tab==='officials'?'active':''"
                    @click="tab='officials';mobileMenuOpen=false"><i class="fas fa-user-tie"></i> Officials</button>
                <button class="mob-item" :class="tab==='announcements'?'active':''"
                    @click="tab='announcements';mobileMenuOpen=false"><i class="fas fa-bullhorn"></i>
                    Announcements</button>
                <button class="mob-item" :class="tab==='events'?'active':''"
                    @click="tab='events';mobileMenuOpen=false"><i class="fas fa-calendar-alt"></i> Events</button>
                <button class="mob-item" :class="tab==='messages'?'active':''"
                    @click="tab='messages';selectedMsg=null;mobileMenuOpen=false">
                    <i class="fas fa-comment-dots"></i> Messages
                    <span x-show="unreadCount>0" x-text="unreadCount"
                        style="margin-left:auto;background:#ef4444;color:#fff;font-size:9px;font-weight:900;padding:2px 7px;border-radius:99px;"></span>
                </button>
                <button class="mob-item" :class="tab==='reports'?'active':''"
                    @click="tab='reports';mobileMenuOpen=false"><i class="fas fa-file-alt"></i> Reports</button>
                <div class="mob-section-lbl">Quick Actions</div>
                <button class="mob-item" @click="addAnnModal=true;mobileMenuOpen=false"><i class="fas fa-plus-circle"
                        style="color:#4ade80;"></i> New Announcement</button>
                <button class="mob-item" @click="addEvtModal=true;mobileMenuOpen=false"><i class="fas fa-plus-circle"
                        style="color:#4ade80;"></i> New Event</button>
                <button class="mob-item" @click="addOffModal=true;photoPreview=null;mobileMenuOpen=false"><i
                        class="fas fa-plus-circle" style="color:#4ade80;"></i> Add Official</button>
                <div class="mob-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            style="width:100%;padding:11px;background:rgba(220,38,38,.25);border:1px solid rgba(220,38,38,.4);color:#fca5a5;font-family:inherit;font-size:11px;font-weight:800;text-transform:uppercase;border-radius:10px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="dash-wrap">

            {{-- GREETING --}}
            <div class="greeting">
                <div>
                    <h1>Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 18 ? 'Afternoon' : 'Evening') }},
                        {{ Auth::user()->first_name ?? 'Admin' }}! </h1>
                    <p>{{ now()->format('l, F d, Y') }} • Barangay San Miguel II Admin Panel</p>
                </div>
                <div class="g-stats">
                    <div class="gs">
                        <div class="gs-n">{{ $totalResidents }}</div>
                        <div class="gs-l">Residents</div>
                    </div>
                    <div class="gs">
                        <div class="gs-n">{{ $pendingDocs }}</div>
                        <div class="gs-l">Pending Docs</div>
                    </div>
                    <div class="gs">
                        <div class="gs-n">{{ $pendingIssues }}</div>
                        <div class="gs-l">Open Issues</div>
                    </div>
                    <div class="gs">
                        <div class="gs-n">{{ $totalPets }}</div>
                        <div class="gs-l">Pets</div>
                    </div>
                </div>
            </div>

            {{-- GLOBAL SEARCH & FILTERS --}}
            <div class="global-search-bar no-print" style="margin-bottom:16px; position:relative;" @click.away="showGlobalResults=false">
                <div style="display:flex;gap:10px;background:#fff;padding:8px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,52,.04);border:1px solid var(--border);flex-wrap:wrap;">
                    <div style="flex:1;min-width:200px;display:flex;align-items:center;background:#f8fafc;border-radius:8px;padding:0 14px; position:relative;">
                        <i class="fas fa-search" style="color:var(--light);"></i>
                        <input type="text" x-model="globalSearchInput" @keydown.enter="performGlobalSearch" @input.debounce.300ms="if(globalSearchInput.length > 2) performGlobalSearch()" @focus="if(globalSearchInput) performGlobalSearch()" placeholder="Search here" style="width:100%;background:transparent;border:none;outline:none;padding:10px 12px;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);">
                        <button x-show="globalSearchInput" @click="globalSearchInput='';showGlobalResults=false;searchOff='';searchAnn='';searchEvt=''" style="background:none;border:none;color:var(--light);cursor:pointer;padding:4px;"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div style="display:flex;gap:10px;position:relative;">
                        <button class="btn" @click.stop="showFilters=!showFilters" style="background:#f1f5f9;color:var(--muted);font-weight:700;padding:0 16px;border-radius:8px;font-size:11px;white-space:nowrap;"><i class="fas fa-sliders-h"></i> Filters</button>
                        <div x-show="showFilters" @click.away="showFilters=false" x-cloak x-transition style="position:absolute;top:100%;right:0;margin-top:8px;background:#fff;border-radius:12px;box-shadow:0 10px 40px rgba(0,0,52,.1);border:1px solid var(--border);z-index:110;min-width:220px;padding:16px;">
                            <div style="font-size:11px;font-weight:900;color:var(--text);letter-spacing:.05em;text-transform:uppercase;margin-bottom:12px;">Filter Residents</div>
                            <div style="font-size:10px;font-weight:700;color:var(--muted);margin-bottom:6px;">BIRTH MONTH</div>
                            <select x-model="filterMonth" @change="applyFilters()" style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;cursor:pointer;background:#f8fafc;">
                                <option value="">Select Month...</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Global Search Results Dropdown --}}
                <div x-show="showGlobalResults" x-cloak class="search-dropdown" x-transition style="position:absolute;top:100%;left:0;right:0;margin-top:8px;background:#fff;border-radius:12px;box-shadow:0 10px 40px rgba(0,0,52,.1);border:1px solid var(--border);z-index:100;max-height:400px;overflow-y:auto;padding:12px;">
                    <template x-if="globalSearchResults.length === 0">
                        <div style="padding:20px;text-align:center;color:var(--muted);font-size:12px;font-weight:600;"><i class="fas fa-search" style="opacity:.2;font-size:24px;display:block;margin-bottom:8px;"></i>No matching results found for "<span x-text="globalSearchInput"></span>".</div>
                    </template>
                    <template x-for="res in globalSearchResults" :key="res.type + res.id">
                        <div @click="goToResult(res)" style="padding:10px 14px;border-bottom:1px solid #f8fafc;cursor:pointer;display:flex;align-items:center;gap:12px;border-radius:8px;transition:background .2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                            <div style="width:36px;height:36px;border-radius:8px;background:#eff6ff;color:#0E5393;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i :class="res.icon"></i>
                            </div>
                            <div style="flex:1;">
                                <div style="font-size:13px;font-weight:800;color:var(--text);" x-text="res.title"></div>
                                <div style="font-size:10px;font-weight:600;color:var(--light);" x-text="res.subtitle"></div>
                            </div>
                            <span style="font-size:9px;font-weight:800;background:#f8fafc;color:var(--muted);padding:3px 8px;border-radius:99px;text-transform:uppercase;border:1px solid var(--border);" x-text="res.type"></span>
                        </div>
                    </template>
                </div>
            </div>

            {{-- TABS --}}
            <div class="tab-bar no-print">
                <button class="tab-btn" :class="tab==='overview'?'active':''" @click="tab='overview'">
                    <i class="fas fa-chart-pie"></i> <span>Overview</span>
                </button>
                <button class="tab-btn" :class="tab==='demographics'?'active':''" @click="tab='demographics'">
                    <i class="fas fa-users"></i> <span>Demographics</span>
                    <span class="tcnt">{{ $totalResidents }}</span>
                </button>
                <button class="tab-btn" :class="tab==='officials'?'active':''" @click="tab='officials'">
                    <i class="fas fa-user-tie"></i> <span>Officials</span>
                    <span class="tcnt">{{ $officials->count() }}</span>
                </button>
                <button class="tab-btn" :class="tab==='announcements'?'active':''" @click="tab='announcements'">
                    <i class="fas fa-bullhorn"></i> <span>Announcements</span>
                    <span class="tcnt">{{ $announcements->count() }}</span>
                </button>
                <button class="tab-btn" :class="tab==='events'?'active':''" @click="tab='events'">
                    <i class="fas fa-calendar-alt"></i> <span>Events</span>
                    <span class="tcnt">{{ $events->count() }}</span>
                </button>
                {{-- MESSAGES TAB --}}
                <button class="tab-btn" :class="tab==='messages'?'active':''" @click="tab='messages';selectedMsg=null">
                    <i class="fas fa-comment-dots"></i> <span>Messages</span>
                    <span class="tcnt" :class="unreadCount > 0 ? 'tcnt-red' : ''">
                        <span x-text="unreadCount > 0 ? unreadCount : {{ count($residentMessages ?? []) }}"></span>
                    </span>
                </button>
                <button class="tab-btn" :class="tab==='reports'?'active':''" @click="tab='reports'">
                    <i class="fas fa-file-alt"></i> <span>Reports</span>
                </button>
            </div>

            {{-- ══ OVERVIEW ══ --}}
            <div x-show="tab==='overview'" x-transition>
                <div class="sg">
                    <div class="sc">
                        <div class="sc-ico" style="background:#eff6ff;"><i class="fas fa-users"
                                style="color:#0E5393;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalResidents }}</div>
                            <div class="sc-l">Total Residents</div>
                        </div>
                    </div>
                    <div class="sc">
                        <div class="sc-ico" style="background:#dcfce7;"><i class="fas fa-file-alt"
                                style="color:#15803d;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalDocs }}</div>
                            <div class="sc-l">Document Requests</div>
                        </div>
                    </div>
                    <div class="sc">
                        <div class="sc-ico" style="background:#fef3c7;"><i class="fas fa-flag"
                                style="color:#a16207;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalIssues }}</div>
                            <div class="sc-l">Issue Reports</div>
                        </div>
                    </div>
                    <div class="sc">
                        <div class="sc-ico" style="background:#fce7f3;"><i class="fas fa-paw"
                                style="color:#be185d;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalPets }}</div>
                            <div class="sc-l">Registered Pets</div>
                        </div>
                    </div>
                </div>
                <div class="chart-grid">
                    <div class="chart-box">
                        <div class="chart-title"><i class="fas fa-file-invoice"></i> Document Requests</div>
                        <div style="position:relative;height:220px;"><canvas id="docChart"></canvas></div>
                    </div>
                    <div class="chart-box">
                        <div class="chart-title"><i class="fas fa-flag"></i> Issues by Department</div>
                        <div style="position:relative;height:220px;"><canvas id="issueChart"></canvas></div>
                    </div>
                </div>
                <div class="chart-grid">
                    <div class="chart-box">
                        <div class="chart-title"><i class="fas fa-paw"></i> Pet Vaccination Status</div>
                        <div style="position:relative;height:220px;"><canvas id="petChart"></canvas></div>
                    </div>
                    <div class="chart-box">
                        <div class="chart-title"><i class="fas fa-venus-mars"></i> Gender Distribution</div>
                        <div style="position:relative;height:220px;"><canvas id="genderChart"></canvas></div>
                    </div>
                </div>
            </div>

            {{-- ══ DEMOGRAPHICS ══ --}}
            <div x-show="tab==='demographics'" x-transition>
                <div class="sg" style="margin-bottom:20px;">
                    <div class="sc">
                        <div class="sc-ico" style="background:#eff6ff;"><i class="fas fa-users"
                                style="color:#0E5393;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalResidents }}</div>
                            <div class="sc-l">Total Residents</div>
                        </div>
                    </div>
                    <div class="sc">
                        <div class="sc-ico" style="background:#dbeafe;"><i class="fas fa-vote-yea"
                                style="color:#1d4ed8;"></i></div>
                        <div>
                            <div class="sc-n">{{ $voters }}</div>
                            <div class="sc-l">Registered Voters</div>
                        </div>
                    </div>
                    <div class="sc">
                        <div class="sc-ico" style="background:#fef3c7;"><i class="fas fa-birthday-cake"
                                style="color:#a16207;"></i></div>
                        <div>
                            <div class="sc-n">{{ $birthdayThisMonth }}</div>
                            <div class="sc-l">Birthday This Month</div>
                        </div>
                    </div>
                    <div class="sc">
                        <div class="sc-ico" style="background:#fce7f3;"><i class="fas fa-user-check"
                                style="color:#be185d;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalUsers }}</div>
                            <div class="sc-l">Registered Accounts</div>
                        </div>
                    </div>
                </div>
                @php
                    $dp = fn($n) => $totalResidents > 0 ? round(($n / $totalResidents) * 100) : 0;
                    $demos = [
                        ['Senior Citizens', 'fa-user-clock', $seniors, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)'],
                        ['PWD', 'fa-wheelchair', $pwds, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)'],
                        ['Solo Parents', 'fa-heart', $soloParents, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)'],
                        ['Students', 'fa-graduation-cap', $students, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)'],
                        ['Minors (Under 18)', 'fa-child', $minors, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)'],
                        ['Adults (18–59)', 'fa-user', $adults, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)'],
                        ['Registered Voters', 'fa-vote-yea', $voters, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)'],
                        ['With Accounts', 'fa-user-check', $totalUsers, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)'],
                    ];
                @endphp
                <div class="demo-grid">
                    @foreach($demos as $d)
                        @php $pct = $dp($d[2]); @endphp
                        <div class="dmcard">
                            <div class="dm-top">
                                <div class="dm-ico" style="background:{{ $d[4] }};"><i class="fas {{ $d[1] }}"
                                        style="color:{{ $d[3] }};"></i></div>
                                <div class="dm-n">{{ $d[2] }}</div>
                            </div>
                            <div class="dm-l">{{ $d[0] }}</div>
                            <div class="bar-bg">
                                <div class="bar-fill" style="width:{{ $pct }}%;background:{{ $d[5] }};"></div>
                            </div>
                            <div class="bar-pct">{{ $pct }}% of total</div>
                        </div>
                    @endforeach
                </div>
                <div class="chart-box" style="margin-bottom:18px;">
                    <div class="chart-title"><i class="fas fa-chart-bar"></i> Classifications Overview</div>
                    <div style="position:relative;height:260px;"><canvas id="demoChart"></canvas></div>
                </div>
                @php $mPct = $totalResidents > 0 ? round(($male / $totalResidents) * 100) : 50;
                $fPct = 100 - $mPct; @endphp
                <div class="gender-wrap">
                    <div class="chart-title"><i class="fas fa-venus-mars"></i> Gender Distribution</div>
                    <p style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:2px;">Based on
                        {{ $totalResidents }} registered residents</p>
                    <div class="gbar">
                        <div class="gbar-m" style="width:{{ $mPct }}%;">{{ $mPct > 8 ? $mPct . '%' : '' }}</div>
                        <div class="gbar-f" style="width:{{ $fPct }}%;">{{ $fPct > 8 ? $fPct . '%' : '' }}</div>
                    </div>
                    <div class="glegend">
                        <div class="gl">
                            <div class="gldot" style="background:#0E5393;"></div> Male — <strong
                                style="color:var(--text);margin-left:3px;">{{ $male }}</strong> &nbsp;({{ $mPct }}%)
                        </div>
                        <div class="gl">
                            <div class="gldot" style="background:#ec4899;"></div> Female — <strong
                                style="color:var(--text);margin-left:3px;">{{ $female }}</strong> &nbsp;({{ $fPct }}%)
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ OFFICIALS ══ --}}
            <div x-show="tab==='officials'" x-transition>
                <div
                    style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:12px;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <select x-model="filterDept" class="finput" style="width:140px;padding:7px 12px;font-size:11px;">
                            <option value="">All Officials</option>
                            <option value="Peace">Peace</option>
                            <option value="VAWC">VAWC</option>
                            <option value="Justice">Justice</option>
                            <option value="Office">Office</option>
                        </select>
                        <input type="text" x-model="searchOff" placeholder="Search official..." class="finput"
                            style="width:220px;padding:7px 12px;font-size:11px;">
                        <button @click="offViewMode='grid'" class="btn btn-sm"
                            :class="offViewMode==='grid'?'btn-primary':'btn-ghost'"><i
                                class="fas fa-th-large"></i></button>
                        <button @click="offViewMode='list'" class="btn btn-sm"
                            :class="offViewMode==='list'?'btn-primary':'btn-ghost'"><i class="fas fa-list"></i></button>
                    </div>
                    <button @click="addOffModal=true;photoPreview=null" class="btn btn-primary"><i
                            class="fas fa-user-plus"></i> Add Official</button>
                </div>
                <div class="card" style="margin-bottom:18px;">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-user-tie"></i> Current Officials</div>
                        <span class="cbadge">{{ $officials->count() }} Active</span>
                    </div>
                    @if($officials->isEmpty())
                        <div class="empty-st"><i class="fas fa-user-tie"></i>
                            <p>No officials yet. Add one from the button above.</p>
                        </div>
                    @else
                        <div :class="offViewMode==='grid'?'off-grid':''" style="padding-bottom:16px;">
                            @foreach($officials as $off)
                                <div :class="offViewMode==='grid'?'off-card':''"
                                    x-show="'{{ strtolower(addslashes($off->name . ' ' . $off->position)) }}'.includes(searchOff.toLowerCase()) && (filterDept === '' || '{{ $off->department }}' === filterDept)"
                                    :style="offViewMode==='list'?'display:flex;align-items:center;gap:14px;background:#f8fafc;border:1px solid var(--border);border-radius:12px;padding:12px;margin:0 16px 10px;text-align:left;':''">
                                    <div class="off-photo-wrap"
                                        :style="offViewMode==='list'?'width:44px;height:44px;margin:0;flex-shrink:0;':''">
                                        <img src="{{ $off->photo ? asset('storage/' . $off->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($off->name) . '&background=0E5393&color=fff&size=128&bold=true' }}"
                                            class="off-photo">
                                    </div>
                                    <div :style="offViewMode==='list'?'flex:1;':''">
                                        <div class="off-name">{{ $off->name }}</div>
                                        <div class="off-pos">{{ $off->position }}</div>
                                        @if($off->term_start)
                                            <div class="off-term">
                                                {{ \Carbon\Carbon::parse($off->term_start)->format('M Y') }}@if($off->term_end) –
                                        {{ \Carbon\Carbon::parse($off->term_end)->format('M Y') }}@endif</div>@endif
                                    </div>
                                    <div class="off-acts"
                                        :style="offViewMode==='list'?'margin-top:0;justify-content:flex-end;':''">
                                        <button
                                            @click="editOff={id:{{ $off->id }},name:'{{ addslashes($off->name) }}',department:'{{ addslashes($off->department) }}',position:'{{ addslashes($off->position) }}',term_start:'{{ $off->term_start }}',term_end:'{{ $off->term_end }}',photo:'{{ $off->photo ? asset('storage/' . $off->photo) : '' }}'};editOffModal=true;editOffPhotoPreview=editOff.photo||null"
                                            class="btn btn-sm btn-edit"><i class="fas fa-edit"></i> Edit</button>
                                        <form action="{{ route('admin.officials.archive', $off->id) }}" method="POST"
                                            onsubmit="return confirm('Archive {{ addslashes($off->name) }}?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-warn"><i class="fas fa-archive"></i>
                                                Archive</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                @if($archivedOfficials->isNotEmpty())
                    <div class="card">
                        <div class="card-head">
                            <div class="card-title" style="color:var(--muted);"><i class="fas fa-archive"
                                    style="color:var(--light);"></i> Archived Officials</div>
                            <span class="cbadge"
                                style="background:#f1f5f9;color:#64748b;">{{ $archivedOfficials->count() }}</span>
                        </div>
                        <div style="overflow-x:auto;">
                            <table style="width:100%;border-collapse:collapse;">
                                <thead>
                                    <tr style="background:#f8fafc;">
                                        <th
                                            style="padding:11px 14px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;text-align:left;border-bottom:1px solid var(--border);">
                                            Official</th>
                                        <th
                                            style="padding:11px 14px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;text-align:left;border-bottom:1px solid var(--border);">
                                            Position</th>
                                        <th
                                            style="padding:11px 14px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;text-align:right;border-bottom:1px solid var(--border);">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($archivedOfficials as $off)
                                        <tr style="border-bottom:1px solid #f8fafc;">
                                            <td style="padding:11px 14px;">
                                                <div style="display:flex;align-items:center;gap:10px;">
                                                    <img src="{{ $off->photo ? asset('storage/' . $off->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($off->name) . '&background=94a3b8&color=fff&size=64&bold=true' }}"
                                                        style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                                                    <div style="font-size:12px;font-weight:800;color:var(--muted);">
                                                        {{ $off->name }}</div>
                                                </div>
                                            </td>
                                            <td style="padding:11px 14px;font-size:11px;color:var(--muted);">
                                                {{ $off->position }}</td>
                                            <td style="padding:11px 14px;text-align:right;">
                                                <form action="{{ route('admin.officials.restore', $off->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success"><i
                                                            class="fas fa-undo"></i> Restore</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ══ ANNOUNCEMENTS ══ --}}
            <div x-show="tab==='announcements'" x-transition>
                <div
                    style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:12px;">
                    <input type="text" x-model="searchAnn" placeholder="Search announcements..." class="finput"
                        style="width:250px;padding:7px 12px;font-size:11px;">
                    <button @click="addAnnModal=true;annPhotoPreview=null" class="btn btn-primary"><i class="fas fa-plus"></i> New
                        Announcement</button>
                </div>
                <div class="card" style="margin-bottom:18px;">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-bullhorn"></i> Active Announcements</div>
                        <span class="cbadge">{{ $announcements->count() }}</span>
                    </div>
                    @if($announcements->isEmpty())
                        <div class="empty-st"><i class="fas fa-bullhorn"></i>
                            <p>No active announcements. Create one!</p>
                        </div>
                    @else
                        @foreach($announcements as $ann)
                            <div class="ann-item"
                                x-show="'{{ strtolower(addslashes($ann->title . ' ' . $ann->content)) }}'.includes(searchAnn.toLowerCase())">
                                @if($ann->image_path)
                                    <div
                                        style="width:80px;height:80px;border-radius:10px;overflow:hidden;flex-shrink:0;border:1px solid var(--border);">
                                        <img src="{{ asset('storage/' . $ann->image_path) }}"
                                            style="width:100%;height:100%;object-fit:cover;">
                                    </div>
                                @endif
                                <div style="flex:1;min-width:0;">
                                    @php
                                        $tagColors = ['Announcement' => ['#dbeafe', '#1d4ed8'], 'Health' => ['#dcfce7', '#15803d'], 'Governance' => ['#ede9fe', '#7c3aed'], 'Community' => ['#ffedd5', '#ea580c'], 'Sanitation' => ['#fef3c7', '#a16207']];
                                        $tc = $tagColors[$ann->tag] ?? ['#f1f5f9', '#475569'];
                                    @endphp
                                    <span class="ann-tag"
                                        style="background:{{ $tc[0] }};color:{{ $tc[1] }};">{{ $ann->tag }}</span>
                                    <div class="ann-title">{{ $ann->title }}</div>
                                    <div class="ann-body">{{ $ann->content }}</div>
                                    <div class="ann-date"><i class="fas fa-clock"
                                            style="margin-right:4px;"></i>{{ $ann->created_at->format('M d, Y') }}</div>
                                </div>
                                <div class="ann-actions">
                                    <button
                                        @click='editAnn={id:{{ $ann->id }},title:@json($ann->title),content:@json($ann->content),tag:@json($ann->tag)};editAnnModal=true;editAnnPhotoPreview=@json($ann->image_path ? asset("storage/" . $ann->image_path) : "")'
                                        class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></button>
                                    <form action="{{ route('admin.announcements.archive', $ann->id) }}" method="POST"
                                        onsubmit="return confirm('Archive this announcement?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-warn"><i
                                                class="fas fa-archive"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if($archivedAnnouncements->isNotEmpty())
                    <div class="card">
                        <div class="card-head">
                            <div class="card-title" style="color:var(--muted);"><i class="fas fa-archive"
                                    style="color:var(--light);"></i> Archived Announcements</div>
                            <span class="cbadge"
                                style="background:#f1f5f9;color:#64748b;">{{ $archivedAnnouncements->count() }}</span>
                        </div>
                        @foreach($archivedAnnouncements as $ann)
                            <div class="ann-item" style="opacity:.6;">
                                <div style="flex:1;min-width:0;">
                                    <div class="ann-title" style="color:var(--muted);">{{ $ann->title }}</div>
                                    <div class="ann-date">Archived {{ $ann->archived_at?->format('M d, Y') }}</div>
                                </div>
                                <div class="ann-actions">
                                    <form action="{{ route('admin.announcements.restore', $ann->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-undo"></i>
                                            Restore</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ══ EVENTS ══ --}}
            <div x-show="tab==='events'" x-transition>
                <div
                    style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:12px;">
                    <input type="text" x-model="searchEvt" placeholder="Search events..." class="finput"
                        style="width:250px;padding:7px 12px;font-size:11px;">
                    <button @click="addEvtModal=true;evtPhotoPreview=null" class="btn btn-primary"><i class="fas fa-plus"></i> New
                        Event</button>
                </div>
                <div class="card" style="margin-bottom:18px;">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-calendar-alt"></i> Active Events & Schedules</div>
                        <span class="cbadge">{{ $events->count() }}</span>
                    </div>
                    @if($events->isEmpty())
                        <div class="empty-st"><i class="fas fa-calendar-alt"></i>
                            <p>No events yet. Create one!</p>
                        </div>
                    @else
                        @foreach($events as $evt)
                            <div class="evt-item"
                                x-show="'{{ strtolower(addslashes($evt->title . ' ' . $evt->location . ' ' . $evt->description)) }}'.includes(searchEvt.toLowerCase())">
                                <div class="evt-day">
                                    <div class="evt-day-num">{{ $evt->day_label }}</div>
                                    <div class="evt-day-sm">{{ $evt->frequency }}</div>
                                </div>
                                @if($evt->image_path)
                                    <div
                                        style="width:60px;height:60px;border-radius:10px;overflow:hidden;flex-shrink:0;border:1px solid var(--border);">
                                        <img src="{{ asset('storage/' . $evt->image_path) }}"
                                            style="width:100%;height:100%;object-fit:cover;">
                                    </div>
                                @endif
                                <div style="flex:1;min-width:0;">
                                    @php $etColors = ['Community' => ['#dcfce7', '#15803d'], 'Health' => ['#dbeafe', '#1d4ed8'], 'Sanitation' => ['#ffedd5', '#ea580c'], 'Governance' => ['#ede9fe', '#7c3aed']];
                                    $etc = $etColors[$evt->tag] ?? ['#f1f5f9', '#475569']; @endphp
                                    <div style="font-size:13px;font-weight:800;color:var(--text);">{{ $evt->title }}</div>
                                    <div
                                        style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;line-height:1.4;">
                                        @if($evt->time_range){{ $evt->time_range }}@endif @if($evt->location) •
                                        {{ $evt->location }}@endif
                                    </div>
                                    @if($evt->description)
                                        <div style="font-size:10px;color:var(--light);font-weight:600;margin-top:2px;">
                                    {{ $evt->description }}</div>@endif
                                    <span
                                        style="font-size:8px;font-weight:900;background:{{ $etc[0] }};color:{{ $etc[1] }};padding:2px 8px;border-radius:99px;display:inline-block;margin-top:4px;">{{ $evt->tag }}</span>
                                </div>
                                <div style="display:flex;gap:5px;flex-shrink:0;">
                                    <button
                                        @click='editEvt={id:{{ $evt->id }},title:@json($evt->title),description:@json($evt->description ?? ""),location:@json($evt->location ?? ""),day_label:@json($evt->day_label),frequency:@json($evt->frequency),time_range:@json($evt->time_range ?? ""),tag:@json($evt->tag)};editEvtModal=true;editEvtPhotoPreview=@json($evt->image_path ? asset("storage/" . $evt->image_path) : "")'
                                        class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></button>
                                    <form action="{{ route('admin.events.archive', $evt->id) }}" method="POST"
                                        onsubmit="return confirm('Archive this event?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-warn"><i
                                                class="fas fa-archive"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if($archivedEvents->isNotEmpty())
                    <div class="card">
                        <div class="card-head">
                            <div class="card-title" style="color:var(--muted);"><i class="fas fa-archive"
                                    style="color:var(--light);"></i> Archived Events</div>
                            <span class="cbadge"
                                style="background:#f1f5f9;color:#64748b;">{{ $archivedEvents->count() }}</span>
                        </div>
                        @foreach($archivedEvents as $evt)
                            <div class="evt-item" style="opacity:.6;">
                                <div style="flex:1;">
                                    <div style="font-size:12px;font-weight:800;color:var(--muted);">{{ $evt->title }}</div>
                                    <div style="font-size:9px;color:var(--light);">Archived
                                        {{ $evt->archived_at?->format('M d, Y') }}</div>
                                </div>
                                <form action="{{ route('admin.events.restore', $evt->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-undo"></i>
                                        Restore</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ══ MESSAGES TAB ══ --}}
            <div x-show="tab==='messages'" x-transition>
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-comment-dots"></i> Resident Messages</div>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <span class="cbadge cbadge-red" x-text="unreadCount + ' unread'"></span>
                            <span class="cbadge">{{ count($residentMessages ?? []) }} total</span>
                            {{-- Filter --}}
                            <div style="display:flex;gap:4px;">
                                <button @click="msgFilter='all';selectedMsg=null"
                                    :class="msgFilter==='all' ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-ghost'">All</button>
                                <button @click="msgFilter='unread';selectedMsg=null"
                                    :class="msgFilter==='unread' ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-ghost'">Unread</button>
                                <button @click="msgFilter='read';selectedMsg=null"
                                    :class="msgFilter==='read' ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-ghost'">Read</button>
                            </div>
                        </div>
                    </div>

                    {{-- TWO-PANE LAYOUT --}}
                    <div style="display:grid;grid-template-columns:1fr 1.4fr;min-height:480px;"
                        x-show="filteredMessages.length > 0">
                        {{-- LEFT: Message list --}}
                        <div style="border-right:1px solid #f1f5f9;overflow-y:auto;max-height:600px;">
                            <template x-for="msg in filteredMessages" :key="msg.id">
                                <div class="msg-item"
                                    :class="{ 'unread': !msg.read_at, 'active-msg': selectedMsg?.id === msg.id }"
                                    :style="selectedMsg?.id === msg.id ? 'background:#dbeafe;border-left:3px solid #0E5393;' : ''"
                                    @click="openMsg(msg)">
                                    {{-- Avatar --}}
                                    <div class="msg-avatar" x-text="(msg.name || 'R').charAt(0).toUpperCase()"></div>
                                    <div style="flex:1;min-width:0;">
                                        <div
                                            style="display:flex;align-items:center;justify-content:space-between;gap:6px;">
                                            <div class="msg-sender" x-text="msg.name || 'Anonymous'"></div>
                                            <div class="msg-time" x-text="msg.time_ago"></div>
                                        </div>
                                        <div class="msg-subject" x-text="msg.subject"></div>
                                        <div class="msg-preview" x-text="msg.message"></div>
                                        <div style="margin-top:5px;display:flex;align-items:center;gap:6px;">
                                            <span x-show="msg.resident_code" x-text="msg.resident_code"
                                                style="font-size:9px;font-weight:900;background:#eff6ff;color:#0E5393;padding:2px 7px;border-radius:99px;"></span>
                                            <span x-show="!msg.read_at"
                                                style="font-size:9px;font-weight:900;background:#fee2e2;color:#dc2626;padding:2px 7px;border-radius:99px;">New</span>
                                            <span x-show="msg.replied_at"
                                                style="font-size:9px;font-weight:900;background:#dcfce7;color:#15803d;padding:2px 7px;border-radius:99px;">✓
                                                Replied</span>
                                        </div>
                                    </div>
                                    <div x-show="!msg.read_at" class="msg-unread-dot"></div>
                                </div>
                            </template>
                        </div>

                        {{-- RIGHT: Message detail --}}
                        <div style="display:flex;flex-direction:column;" x-show="selectedMsg">
                            {{-- Message content --}}
                            <div class="msg-detail-box" style="flex:1;overflow-y:auto;max-height:420px;">
                                <div
                                    style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:8px;">
                                    <div>
                                        <div style="font-size:16px;font-weight:900;color:var(--text);"
                                            x-text="selectedMsg?.subject"></div>
                                        <div style="font-size:12px;color:var(--muted);font-weight:600;margin-top:3px;">
                                            From: <strong x-text="selectedMsg?.name || 'Anonymous'"
                                                style="color:var(--text);"></strong>
                                            <span x-show="selectedMsg?.email"> — <span x-text="selectedMsg?.email"
                                                    style="color:var(--brand);"></span></span>
                                        </div>
                                        <div style="display:flex;gap:6px;margin-top:5px;flex-wrap:wrap;">
                                            <span x-show="selectedMsg?.resident_code"
                                                x-text="selectedMsg?.resident_code"
                                                style="font-size:10px;font-weight:900;background:#eff6ff;color:#0E5393;padding:3px 10px;border-radius:99px;"></span>
                                            <span style="font-size:10px;color:var(--light);font-weight:600;"
                                                x-text="selectedMsg?.created_at_formatted"></span>
                                        </div>
                                    </div>
                                    <div style="display:flex;gap:6px;">
                                        <span x-show="selectedMsg?.replied_at"
                                            style="font-size:10px;font-weight:900;background:#dcfce7;color:#15803d;padding:4px 12px;border-radius:99px;"><i
                                                class="fas fa-check-circle"></i> Replied</span>
                                    </div>
                                </div>
                                <div style="background:#f8fafc;border:1px solid var(--border);border-radius:12px;padding:18px;font-size:13px;color:var(--text);font-weight:600;line-height:1.7;white-space:pre-wrap;"
                                    x-text="selectedMsg?.message"></div>

                                {{-- Previous reply if exists --}}
                                <div x-show="selectedMsg?.admin_reply" style="margin-top:16px;">
                                    <div
                                        style="font-size:10px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;">
                                        <i class="fas fa-reply" style="margin-right:4px;"></i> Your Previous Reply</div>
                                    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:12px;padding:14px;font-size:13px;color:#1d4ed8;font-weight:600;line-height:1.6;white-space:pre-wrap;"
                                        x-text="selectedMsg?.admin_reply"></div>
                                </div>
                            </div>

                            {{-- Reply bar --}}
                            <div class="msg-reply-bar">
                                <div style="flex:1;">
                                    <div x-show="replySent"
                                        style="background:#dcfce7;border:1px solid #bbf7d0;border-radius:9px;padding:10px 14px;font-size:12px;font-weight:800;color:#15803d;margin-bottom:10px;">
                                        <i class="fas fa-check-circle"></i> Reply sent successfully via email!
                                    </div>
                                    <textarea x-model="replyText" rows="3"
                                        placeholder="Type your reply to the resident here..."
                                        style="width:100%;padding:10px 13px;background:#fff;border:1.5px solid var(--border);border-radius:10px;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;resize:vertical;transition:border-color .15s;"
                                        @focus="$el.style.borderColor='#0E5393'"
                                        @blur="$el.style.borderColor='#e2e8f0'"></textarea>
                                    <div
                                        style="display:flex;justify-content:space-between;align-items:center;margin-top:8px;flex-wrap:wrap;gap:6px;">
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;">
                                            <i class="fas fa-info-circle" style="margin-right:4px;"></i>
                                            Reply will be sent to <span x-text="selectedMsg?.email || 'resident'"
                                                style="font-weight:800;color:var(--brand);"></span>
                                        </div>
                                        <button @click="sendReply()" class="btn btn-primary btn-sm"
                                            :disabled="replySending || !replyText">
                                            <span x-show="!replySending"><i class="fas fa-paper-plane"></i> Send
                                                Reply</span>
                                            <span x-show="replySending"><i class="fas fa-spinner fa-spin"></i>
                                                Sending...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- No message selected placeholder --}}
                        <div x-show="!selectedMsg"
                            style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:60px 20px;color:var(--light);">
                            <i class="fas fa-comment-dots" style="font-size:48px;opacity:.15;margin-bottom:14px;"></i>
                            <p style="font-size:14px;font-weight:700;">Select a message to read</p>
                            <p style="font-size:12px;font-weight:600;margin-top:4px;color:var(--light);">Click any
                                message on the left</p>
                        </div>
                    </div>

                    {{-- Empty state --}}
                    <div x-show="filteredMessages.length === 0" class="empty-st">
                        <i class="fas fa-comment-slash"></i>
                        <p
                            x-text="msgFilter === 'unread' ? 'No unread messages!' : 'No messages yet. Residents will message you from the portal.'">
                        </p>
                    </div>
                </div>
            </div>

            {{-- ══ REPORTS ══ --}}
            <div x-show="tab==='reports'" x-transition>
                <div class="card no-print" style="margin-bottom:18px;">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-file-alt"></i> Generate Barangay Report</div>
                        <div style="display:flex;align-items:center;flex-wrap:wrap;gap:8px;" class="no-print">
                            <button @click="lguSyncModal=true" class="btn btn-primary"
                                style="background:linear-gradient(135deg,#0E5393,#04192D);"><i class="fas fa-sync"></i>
                                LGU Sync</button>
                            <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i>
                                Print</button>
                            <button onclick="downloadReport()" class="btn btn-primary"
                                style="background:linear-gradient(135deg,#059669,#064e3b);"><i
                                    class="fas fa-download"></i> Download</button>
                        </div>
                    </div>
                    <div style="padding:16px 18px;border-bottom:1px solid #f1f5f9;" class="no-print">
                        <p style="font-size:10px;color:var(--muted);font-weight:600;">Select report type to preview then
                            print:</p>
                        <div style="display:flex;gap:8px;margin-top:10px;flex-wrap:wrap;">
                            <button @click="reportType='full'"
                                :class="reportType==='full'?'btn btn-primary btn-sm':'btn btn-ghost btn-sm'">Full
                                Report</button>
                            <button @click="reportType='residents'"
                                :class="reportType==='residents'?'btn btn-primary btn-sm':'btn btn-ghost btn-sm'">Residents
                                Only</button>
                            <button @click="reportType='documents'"
                                :class="reportType==='documents'?'btn btn-primary btn-sm':'btn btn-ghost btn-sm'">Documents
                                Only</button>
                            <button @click="reportType='issues'"
                                :class="reportType==='issues'?'btn btn-primary btn-sm':'btn btn-ghost btn-sm'">Issues
                                Only</button>
                        </div>
                    </div>
                </div>
                <div class="report-section" id="print-report">
                    <div
                        style="text-align:center;margin-bottom:24px;padding-bottom:16px;border-bottom:2px solid #0E5393;">
                        <div
                            style="display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:10px;">
                            <img src="{{ asset('images/circlelogo.png') }}"
                                style="width:60px;height:60px;border-radius:50%;object-fit:cover;"
                                onerror="this.style.display='none'">
                            <div style="text-align:left;">
                                <div
                                    style="font-size:10px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">
                                    Republic of the Philippines • Province of Cavite • City of Dasmariñas</div>
                                <div
                                    style="font-size:18px;font-weight:900;color:#0f172a;text-transform:uppercase;letter-spacing:.04em;">
                                    Barangay San Miguel II</div>
                                <div style="font-size:10px;color:#64748b;font-weight:600;">Office of the Punong Barangay
                                </div>
                            </div>
                        </div>
                        <div style="font-size:14px;font-weight:900;color:#0E5393;text-transform:uppercase;letter-spacing:.06em;"
                            x-text="reportType==='full'?'Comprehensive Barangay Report':reportType==='residents'?'Resident Report':reportType==='documents'?'Document Requests Report':'Issue Reports Report'">
                        </div>
                        <div style="font-size:11px;color:#64748b;margin-top:4px;font-weight:600;">Generated:
                            {{ now()->format('F d, Y') }} • {{ now()->format('h:i A') }}</div>
                    </div>
                    <div x-show="reportType==='full'||reportType==='residents'">
                        <div
                            style="font-size:11px;font-weight:900;color:#0E5393;text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;padding-bottom:6px;border-bottom:1px solid #e2e8f0;">
                            I. Resident Summary</div>
                        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:18px;">
                            @foreach([['Total Residents', $totalResidents], ['Registered Voters', $voters], ['Senior Citizens', $seniors], ['PWD', $pwds], ['Solo Parents', $soloParents], ['Students', $students], ['Minors', $minors], ['Adults', $adults]] as $r)
                                <div
                                    style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:10px;text-align:center;">
                                    <div style="font-size:20px;font-weight:900;color:#0f172a;">{{ $r[1] }}</div>
                                    <div
                                        style="font-size:8px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.05em;">
                                        {{ $r[0] }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px;">
                            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:12px;">
                                <div
                                    style="font-size:10px;font-weight:900;color:#64748b;text-transform:uppercase;margin-bottom:6px;">
                                    Gender Distribution</div>
                                <div style="display:flex;justify-content:space-between;">
                                    <span style="font-size:12px;font-weight:800;">Male: {{ $male }}
                                        ({{ $totalResidents > 0 ? round(($male / $totalResidents) * 100) : 0 }}%)</span>
                                    <span style="font-size:12px;font-weight:800;">Female: {{ $female }}
                                        ({{ $totalResidents > 0 ? round(($female / $totalResidents) * 100) : 0 }}%)</span>
                                </div>
                            </div>
                            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:12px;">
                                <div
                                    style="font-size:10px;font-weight:900;color:#64748b;text-transform:uppercase;margin-bottom:6px;">
                                    Pet Registry</div>
                                <div style="display:flex;justify-content:space-between;">
                                    <span style="font-size:12px;font-weight:800;">Total: {{ $totalPets }}</span>
                                    <span style="font-size:12px;font-weight:800;">Vaccinated: {{ $vaccinated }}</span>
                                    <span style="font-size:12px;font-weight:800;">Unvaccinated:
                                        {{ $unvaccinated }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-show="reportType==='full'||reportType==='documents'">
                        <div style="font-size:11px;font-weight:900;color:#0E5393;text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;padding-bottom:6px;border-bottom:1px solid #e2e8f0;"
                            x-text="reportType==='documents'?'I. Document Requests Summary':'II. Document Requests Summary'">
                        </div>
                        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;">
                            @foreach([['Total Requests', $totalDocs, '#0E5393'], ['Pending', $pendingDocs, '#a16207'], ['Processing', $processingDocs, '#1d4ed8'], ['Ready for Pickup', $readyDocs, '#15803d']] as $r)
                                <div
                                    style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:10px;text-align:center;">
                                    <div style="font-size:20px;font-weight:900;color:{{ $r[2] }};">{{ $r[1] }}</div>
                                    <div
                                        style="font-size:8px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.05em;">
                                        {{ $r[0] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div x-show="reportType==='full'||reportType==='issues'">
                        <div style="font-size:11px;font-weight:900;color:#0E5393;text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;padding-bottom:6px;border-bottom:1px solid #e2e8f0;"
                            x-text="reportType==='issues'?'I. Issue Reports Summary':'III. Issue Reports Summary'">
                        </div>
                        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;">
                            @foreach([['Total Reports', $totalIssues, '#0f172a'], ['VAWC Cases', $vawcIssues, '#7c3aed'], ['Peace & Order', $peaceIssues, '#059669'], ['Justice/Blotter', $justiceIssues, '#1d4ed8']] as $r)
                                <div
                                    style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:10px;text-align:center;">
                                    <div style="font-size:20px;font-weight:900;color:{{ $r[2] }};">{{ $r[1] }}</div>
                                    <div
                                        style="font-size:8px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.05em;">
                                        {{ $r[0] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div style="margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                        <div style="text-align:center;">
                            <div style="height:36px;"></div>
                            <div style="border-top:2px solid #0f172a;padding-top:4px;">
                                <div style="font-size:12px;font-weight:900;text-transform:uppercase;">MARVIN M. BENIS
                                </div>
                                <div style="font-size:10px;font-style:italic;color:#64748b;">Punong Barangay</div>
                            </div>
                        </div>
                        <div style="text-align:center;">
                            <div style="height:36px;"></div>
                            <div style="border-top:2px solid #0f172a;padding-top:4px;">
                                <div style="font-size:12px;font-weight:900;text-transform:uppercase;">
                                    {{ Auth::user()->first_name ?? '' }} {{ Auth::user()->last_name ?? '' }}</div>
                                <div style="font-size:10px;font-style:italic;color:#64748b;">Prepared by — Admin</div>
                            </div>
                        </div>
                    </div>
                    <div
                        style="margin-top:20px;text-align:center;font-size:9px;color:#94a3b8;font-weight:600;border-top:1px solid #e2e8f0;padding-top:10px;">
                        This report was generated electronically by the Barangay SM2 Management System on
                        {{ now()->format('F d, Y \a\t h:i A') }}.
                    </div>
                </div>
            </div>

        </div>{{-- /dash-wrap --}}

        {{-- ══ MODALS ══ --}}

        {{-- Add Announcement --}}
        <div x-show="addAnnModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="addAnnModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-bullhorn"></i></div> New Announcement
                        </div><button @click="addAnnModal=false" class="mclose"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="fgrp"><label class="flbl">Title *</label><input type="text" name="title" required
                                class="finput" placeholder="e.g. Pista ng Barangay 2026"></div>
                        <div class="fgrp"><label class="flbl">Upload Photo</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="height:110px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;" :style="annPhotoPreview?'border:2px solid #0E5393':''" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                                    <img x-show="annPhotoPreview" :src="annPhotoPreview" style="width:100%;height:100%;object-fit:contain;background:#f8fafc;">
                                    <div x-show="!annPhotoPreview" style="text-align:center;"><i class="fas fa-image" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i><div style="font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;">Upload Photo</div><div style="font-size:9px;font-weight:600;color:var(--light);">JPG, PNG up to 5MB</div></div>
                                </div>
                                <input type="file" name="image" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>annPhotoPreview=e.target.result;r.readAsDataURL(f)}">
                            </label>
                        </div>
                        <div class="fgrp"><label class="flbl">Tag / Category</label><select name="tag" class="finput"
                                style="appearance:none;cursor:pointer;">
                                <option>Announcement</option>
                                <option>Health</option>
                                <option>Governance</option>
                                <option>Community</option>
                                <option>Sanitation</option>
                            </select></div>
                        <div class="fgrp"><label class="flbl">Content *</label><textarea name="content" required
                                rows="4" class="finput" style="resize:vertical;"
                                placeholder="Write your announcement here..."></textarea></div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                @click="addAnnModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                class="btn btn-primary"><i class="fas fa-paper-plane"></i> Post Announcement</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Announcement --}}
        <div x-show="editAnnModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="editAnnModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-edit"></i></div> Edit Announcement
                        </div><button @click="editAnnModal=false" class="mclose"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                    <form :action="'/admin/announcements/'+editAnn.id" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="fgrp"><label class="flbl">Title *</label><input type="text" name="title" required
                                class="finput" :value="editAnn.title"></div>
                        <div class="fgrp"><label class="flbl">Update Photo</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="height:110px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;" :style="editAnnPhotoPreview?'border:2px solid #0E5393':''" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                                    <img x-show="editAnnPhotoPreview" :src="editAnnPhotoPreview" style="width:100%;height:100%;object-fit:contain;background:#f8fafc;">
                                    <div x-show="!editAnnPhotoPreview" style="text-align:center;"><i class="fas fa-image" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i><div style="font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;">Upload Photo</div><div style="font-size:9px;font-weight:600;color:var(--light);">Click to change existing photo</div></div>
                                </div>
                                <input type="file" name="image" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>editAnnPhotoPreview=e.target.result;r.readAsDataURL(f)}">
                            </label>
                        </div>
                        <div class="fgrp"><label class="flbl">Tag / Category</label><select name="tag" class="finput"
                                style="appearance:none;cursor:pointer;">
                                <option>Announcement</option>
                                <option>Health</option>
                                <option>Governance</option>
                                <option>Community</option>
                                <option>Sanitation</option>
                            </select></div>
                        <div class="fgrp"><label class="flbl">Content *</label><textarea name="content" required
                                rows="4" class="finput" style="resize:vertical;" x-text="editAnn.content"></textarea>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                @click="editAnnModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button></div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Add Event --}}
        <div x-show="addEvtModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="addEvtModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-calendar-plus"></i></div> New Event
                        </div><button @click="addEvtModal=false" class="mclose"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="fgrp"><label class="flbl">Event Title *</label><input type="text" name="title"
                                required class="finput" placeholder="e.g. Weekly Clean-Up Drive"></div>
                        <div class="fgrp"><label class="flbl">Upload Photo</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="height:110px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;" :style="evtPhotoPreview?'border:2px solid #0E5393':''" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                                    <img x-show="evtPhotoPreview" :src="evtPhotoPreview" style="width:100%;height:100%;object-fit:contain;background:#f8fafc;">
                                    <div x-show="!evtPhotoPreview" style="text-align:center;"><i class="fas fa-image" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i><div style="font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;">Upload Photo</div><div style="font-size:9px;font-weight:600;color:var(--light);">JPG, PNG up to 5MB</div></div>
                                </div>
                                <input type="file" name="image" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>evtPhotoPreview=e.target.result;r.readAsDataURL(f)}">
                            </label>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Day Label *</label><input type="text" name="day_label" required
                                    class="finput" placeholder="e.g. SAT, MON, WED"></div>
                            <div><label class="flbl">Frequency *</label><select name="frequency" class="finput"
                                    style="appearance:none;cursor:pointer;" required>
                                    <option>Weekly</option>
                                    <option>Monthly</option>
                                    <option>Bi-weekly</option>
                                    <option>Quarterly</option>
                                    <option>Annual</option>
                                    <option>One-time</option>
                                </select></div>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Time Range</label><input type="text" name="time_range"
                                    class="finput" placeholder="e.g. 6:00 AM – 9:00 AM"></div>
                            <div><label class="flbl">Location</label><input type="text" name="location" class="finput"
                                    placeholder="e.g. Brgy. Hall"></div>
                        </div>
                        <div class="fgrp"><label class="flbl">Tag</label><select name="tag" class="finput"
                                style="appearance:none;cursor:pointer;">
                                <option>Community</option>
                                <option>Health</option>
                                <option>Sanitation</option>
                                <option>Governance</option>
                            </select></div>
                        <div class="fgrp"><label class="flbl">Description</label><textarea name="description" rows="2"
                                class="finput" style="resize:vertical;" placeholder="Optional details..."></textarea>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                @click="addEvtModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                class="btn btn-primary"><i class="fas fa-save"></i> Save Event</button></div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Event --}}
        <div x-show="editEvtModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="editEvtModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-calendar-edit"></i></div> Edit Event
                        </div><button @click="editEvtModal=false" class="mclose"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                    <form :action="'/admin/events/'+editEvt.id" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="fgrp"><label class="flbl">Event Title *</label><input type="text" name="title"
                                required class="finput" :value="editEvt.title"></div>
                        <div class="fgrp"><label class="flbl">Update Photo</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="height:110px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;" :style="editEvtPhotoPreview?'border:2px solid #0E5393':''" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                                    <img x-show="editEvtPhotoPreview" :src="editEvtPhotoPreview" style="width:100%;height:100%;object-fit:contain;background:#f8fafc;">
                                    <div x-show="!editEvtPhotoPreview" style="text-align:center;"><i class="fas fa-image" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i><div style="font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;">Upload Photo</div><div style="font-size:9px;font-weight:600;color:var(--light);">Click to change existing photo</div></div>
                                </div>
                                <input type="file" name="image" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>editEvtPhotoPreview=e.target.result;r.readAsDataURL(f)}">
                            </label>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Day Label *</label><input type="text" name="day_label" required
                                    class="finput" :value="editEvt.day_label"></div>
                            <div><label class="flbl">Frequency *</label><select name="frequency" class="finput"
                                    style="appearance:none;cursor:pointer;" required>
                                    <option>Weekly</option>
                                    <option>Monthly</option>
                                    <option>Bi-weekly</option>
                                    <option>Quarterly</option>
                                    <option>Annual</option>
                                    <option>One-time</option>
                                </select></div>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Time Range</label><input type="text" name="time_range"
                                    class="finput" :value="editEvt.time_range"></div>
                            <div><label class="flbl">Location</label><input type="text" name="location" class="finput"
                                    :value="editEvt.location"></div>
                        </div>
                        <div class="fgrp"><label class="flbl">Tag</label><select name="tag" class="finput"
                                style="appearance:none;cursor:pointer;">
                                <option>Community</option>
                                <option>Health</option>
                                <option>Sanitation</option>
                                <option>Governance</option>
                            </select></div>
                        <div class="fgrp"><label class="flbl">Description</label><textarea name="description" rows="2"
                                class="finput" style="resize:vertical;" x-text="editEvt.description"></textarea></div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                @click="editEvtModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button></div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Official --}}
        <div x-show="editOffModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="editOffModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-user-edit"></i></div> Edit Official
                        </div><button @click="editOffModal=false" class="mclose"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                    <form :action="'/admin/officials/'+editOff.id" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="fgrp"><label class="flbl">Official Photo</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="height:110px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;" :style="editOffPhotoPreview?'border:2px solid #0E5393':''" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                                    <img x-show="editOffPhotoPreview" :src="editOffPhotoPreview" style="width:100%;height:100%;object-fit:contain;background:#f8fafc;">
                                    <div x-show="!editOffPhotoPreview" style="text-align:center;"><i class="fas fa-id-badge" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i><div style="font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;">Upload Photo</div><div style="font-size:9px;font-weight:600;color:var(--light);">Click to change existing photo</div></div>
                                </div>
                                <input type="file" name="photo" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>editOffPhotoPreview=e.target.result;r.readAsDataURL(f)}">
                            </label>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Full Name *</label><input type="text" name="name" required
                                    class="finput" :value="editOff.name"></div>
                            <div><label class="flbl">Position *</label><input type="text" name="position"
                                    class="finput" :value="editOff.position" required></div>
                        </div>
                        <div class="fgrp">
                            <label class="flbl">Department *</label>
                            <select name="department" class="finput" :value="editOff.department" required>
                                <option value="">None</option>
                                <option value="Peace">Peace</option>
                                <option value="VAWC">VAWC</option>
                                <option value="Justice">Justice</option>
                                <option value="Office">Office</option>
                            </select>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Term Start</label><input type="date" name="term_start"
                                    class="finput" :value="editOff.term_start"></div>
                            <div><label class="flbl">Term End</label><input type="date" name="term_end" class="finput"
                                    :value="editOff.term_end"></div>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                @click="editOffModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button></div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Add Official --}}
        <div x-show="addOffModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="addOffModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-user-tie"></i></div> Add New Official
                        </div><button @click="addOffModal=false" class="mclose"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('admin.officials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="fgrp"><label class="flbl">Official Photo</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="height:110px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;" :style="photoPreview?'border:2px solid #0E5393':''" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                                    <img x-show="photoPreview" :src="photoPreview" style="width:100%;height:100%;object-fit:contain;background:#f8fafc;">
                                    <div x-show="!photoPreview" style="text-align:center;"><i class="fas fa-id-badge" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i><div style="font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;">Upload Photo</div><div style="font-size:9px;font-weight:600;color:var(--light);">JPG, PNG up to 5MB</div></div>
                                </div>
                                <input type="file" name="photo" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>photoPreview=e.target.result;r.readAsDataURL(f)}">
                            </label>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Full Name *</label><input type="text" name="name" required
                                    class="finput" placeholder="Hon. Juan Dela Cruz"></div>
                            <div><label class="flbl">Position *</label><input type="text" name="position"
                                    class="finput" placeholder="e.g. Punong Barangay" required></div>
                        </div>
                        <div class="fgrp">
                            <label class="flbl">Department *</label>
                            <select name="department" class="finput" required>
                                <option value="">None</option>
                                <option value="Peace">Peace</option>
                                <option value="VAWC">VAWC</option>
                                <option value="Justice">Justice</option>
                                <option value="Office">Office</option>
                            </select>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Term Start</label><input type="date" name="term_start"
                                    class="finput"></div>
                            <div><label class="flbl">Term End</label><input type="date" name="term_end" class="finput">
                            </div>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                @click="addOffModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                class="btn btn-primary"><i class="fas fa-save"></i> Save Official</button></div>
                    </form>
                </div>
            </div>
        </div>

        {{-- LGU Sync Confirmation Modal --}}
        <div x-show="lguSyncModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="lguSyncModal=false" style="max-width:400px;border-bottom:5px solid #d97706;">
                <div class="modal-in">
                    <div class="modal-hd" style="border-bottom:none;padding-bottom:0;margin-bottom:12px;">
                        <div class="modal-ttl" style="color:#d97706;">
                            <div class="mico" style="background:#fef3c7;"><i class="fas fa-exclamation-triangle" style="color:#d97706;"></i></div> SECURITY ALERT
                        </div>
                        <button @click="lguSyncModal=false" class="mclose" style="color:#ef4444;"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div style="font-size:12px;font-weight:600;color:var(--muted);line-height:1.6;margin-bottom:20px;padding-left:4px;">
                        You are about to export Barangay Resident Data for LGU Synchronization. Ensure this file is handled according to the <strong>Data Privacy Act of 2012</strong>. Proceed?
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:9px;">
                        <button type="button" @click="lguSyncModal=false" class="btn btn-ghost">Cancel</button>
                        <a href="{{ route('admin.lgu.sync') }}" @click="lguSyncModal=false" class="btn btn-warn"><i class="fas fa-download"></i> Proceed to Download</a>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- /x-data --}}

    <script>
        const cfg = { plugins: { legend: { position: 'bottom', labels: { font: { family: 'Plus Jakarta Sans', weight: '700', size: 11 }, padding: 14, usePointStyle: true, pointStyleWidth: 10 } } }, responsive: true, maintainAspectRatio: false };
        new Chart(document.getElementById('docChart'), { type: 'doughnut', data: { labels: ['Pending', 'Processing', 'Ready', 'Released'], datasets: [{ data: [{{$pendingDocs}},{{$processingDocs}},{{$readyDocs}},{{$totalDocs - $pendingDocs - $processingDocs - $readyDocs}}], backgroundColor: ['#d97706', '#0E5393', '#059669', '#94a3b8'], borderWidth: 3, borderColor: '#fff', hoverOffset: 6 }] }, options: { ...cfg, cutout: '62%' } });
        new Chart(document.getElementById('issueChart'), { type: 'doughnut', data: { labels: ['VAWC', 'Peace & Order', 'Justice'], datasets: [{ data: [{{$vawcIssues}},{{$peaceIssues}},{{$justiceIssues}}], backgroundColor: ['#7c3aed', '#059669', '#0E5393'], borderWidth: 3, borderColor: '#fff', hoverOffset: 6 }] }, options: { ...cfg, cutout: '62%' } });
        new Chart(document.getElementById('petChart'), { type: 'doughnut', data: { labels: ['Vaccinated', 'Unvaccinated', 'Partial'], datasets: [{ data: [{{$vaccinated}},{{$unvaccinated}},{{$totalPets - $vaccinated - $unvaccinated}}], backgroundColor: ['#059669', '#dc2626', '#d97706'], borderWidth: 3, borderColor: '#fff', hoverOffset: 6 }] }, options: { ...cfg, cutout: '62%' } });
        new Chart(document.getElementById('genderChart'), { type: 'doughnut', data: { labels: ['Male', 'Female'], datasets: [{ data: [{{$male}},{{$female}}], backgroundColor: ['#0E5393', '#ec4899'], borderWidth: 3, borderColor: '#fff', hoverOffset: 6 }] }, options: { ...cfg, cutout: '62%' } });
        new Chart(document.getElementById('demoChart'), { type: 'bar', data: { labels: ['Seniors', 'PWD', 'Solo Parents', 'Students', 'Minors', 'Adults', 'Voters'], datasets: [{ label: 'Count', data: [{{$seniors}},{{$pwds}},{{$soloParents}},{{$students}},{{$minors}},{{$adults}},{{$voters}}], backgroundColor: ['rgba(14,83,147,.7)', 'rgba(14,83,147,.65)', 'rgba(14,83,147,.6)', 'rgba(14,83,147,.55)', 'rgba(14,83,147,.7)', 'rgba(14,83,147,.8)', 'rgba(14,83,147,.9)'], borderRadius: 8, borderWidth: 0 }] }, options: { ...cfg, plugins: { ...cfg.plugins, legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,.04)' }, ticks: { font: { family: 'Plus Jakarta Sans', weight: '700', size: 10 }, color: '#94a3b8' } }, x: { grid: { display: false }, ticks: { font: { family: 'Plus Jakarta Sans', weight: '700', size: 10 }, color: '#64748b' } } } } });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        async function downloadReport() {
            const btn = document.querySelector('[onclick="downloadReport()"]');
            const origHtml = btn ? btn.innerHTML : '';
            if (btn) { btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...'; btn.disabled = true; }

            try {
                const { jsPDF } = window.jspdf;
                const el = document.getElementById('print-report');
                if (!el) return;

                // Temporarily show element fully for capture
                el.style.maxHeight = 'none';
                el.style.overflow = 'visible';

                const canvas = await html2canvas(el, {
                    scale: 2,
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: '#ffffff',
                    logging: false,
                    width: el.scrollWidth,
                    height: el.scrollHeight,
                    windowWidth: 1200
                });

                el.style.maxHeight = '';
                el.style.overflow = '';

                const imgData = canvas.toDataURL('image/jpeg', 0.95);
                const pdf = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });

                const pageW = pdf.internal.pageSize.getWidth();
                const pageH = pdf.internal.pageSize.getHeight();
                const margin = 12;
                const contentW = pageW - margin * 2;
                const imgH = (canvas.height * contentW) / canvas.width;

                let yPos = margin;
                let remaining = imgH;

                // Slice image across multiple pages if needed
                const pageContentH = pageH - margin * 2;
                while (remaining > 0) {
                    const sliceH = Math.min(remaining, pageContentH);
                    const srcY = (imgH - remaining) * (canvas.height / imgH);
                    const srcH = sliceH * (canvas.height / imgH);

                    // Create a temporary canvas for the slice
                    const sliceCanvas = document.createElement('canvas');
                    sliceCanvas.width = canvas.width;
                    sliceCanvas.height = srcH;
                    const ctx = sliceCanvas.getContext('2d');
                    ctx.drawImage(canvas, 0, srcY, canvas.width, srcH, 0, 0, canvas.width, srcH);
                    const sliceData = sliceCanvas.toDataURL('image/jpeg', 0.95);

                    pdf.addImage(sliceData, 'JPEG', margin, yPos, contentW, sliceH);
                    remaining -= sliceH;
                    if (remaining > 0) { pdf.addPage(); yPos = margin; }
                }

                pdf.save('Barangay_SM2_Report_{{ now()->format("Y-m-d") }}.pdf');
            } catch (err) {
                console.error('PDF error:', err);
                alert('Download failed. Please use Print > Save as PDF instead.');
            } finally {
                if (btn) { btn.innerHTML = origHtml; btn.disabled = false; }
            }
        }
    </script>
</body>

</html>
