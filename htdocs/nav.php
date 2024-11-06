<style>
    nav {
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #1F2739;
        padding: 15px 0;
        z-index: 10;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    nav a {
        background-color: #185875;
        display: inline-block;
        padding: 10px 15px;
        margin: 0 5px;
        color: white;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.3s ease;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
    }

    nav a:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: all 0.5s;
    }

    nav a:hover:before {
        left: 100%;
    }

    nav a:hover {
        background-color: #FB667A;
        box-shadow: 0 0 15px rgba(251, 102, 122, 0.5);
        transform: translateY(-3px);
    }

    @media (max-width: 768px) {
        nav {
            padding: 10px 0;
        }
        nav a {
            padding: 8px 15px;
            font-size: 14px;
        }
    }
</style>

<nav>
    <a href="c_list.php">Clients</a>
    <a href="items.php">Items</a>
    <a href="purchases.php">Store Purchases</a>
    <a href="sales.php">Sales</a>
</nav>