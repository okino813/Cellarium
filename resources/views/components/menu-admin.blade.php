<nav style="background-color: #2c3e50; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; height: 70px;">
            <!-- Logo Admin -->
            <div style="display: flex; align-items: center;">
                <a href="{{ route('admin.index') }}" style="font-size: 20px; font-weight: bold; color: white; text-decoration: none;">
                    🔧 Admin
                </a>
            </div>

            <!-- Burger menu pour mobile -->
            <button id="burger-btn" onclick="toggleMobileMenu()" style="display: none; background: none; border: none; color: white; font-size: 28px; cursor: pointer; padding: 5px;">
                ☰
            </button>

            <!-- Navigation principale (desktop) -->
            <div id="desktop-menu" style="display: flex; align-items: center; gap: 20px;">
                <a href="{{ route('admin.index') }}" style="color: #ecf0f1; text-decoration: none; font-size: 16px; font-weight: 500; transition: color 0.3s;" onmouseover="this.style.color='#3498db'" onmouseout="this.style.color='#ecf0f1'">
                    📊 Dashboard
                </a>

                <div class="dropdown" style="position: relative; display: inline-block;">
                    <button onclick="toggleDropdown('stock-menu')" style="color: #ecf0f1; background: none; border: none; font-size: 16px; font-weight: 500; cursor: pointer; padding: 8px 12px;">
                        📦 Stock ▼
                    </button>
                    <div id="stock-menu" style="display: none; position: absolute; background-color: white; min-width: 200px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); border-radius: 4px; margin-top: 5px; z-index: 1000;">
                        <a href="{{ route('admin.items.index') }}" style="display: block; padding: 12px 16px; color: #2c3e50; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#ecf0f1'" onmouseout="this.style.backgroundColor='white'">Items</a>
                        <a href="{{ route('admin.movement.index') }}" style="display: block; padding: 12px 16px; color: #2c3e50; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#ecf0f1'" onmouseout="this.style.backgroundColor='white'">Mouvements</a>
                        <a href="{{ route('admin.attribution.index') }}" style="display: block; padding: 12px 16px; color: #2c3e50; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#ecf0f1'" onmouseout="this.style.backgroundColor='white'">Attributions</a>
                    </div>
                </div>

                <div class="dropdown" style="position: relative; display: inline-block;">
                    <button onclick="toggleDropdown('config-menu')" style="color: #ecf0f1; background: none; border: none; font-size: 16px; font-weight: 500; cursor: pointer; padding: 8px 12px;">
                        ⚙️ Config ▼
                    </button>
                    <div id="config-menu" style="display: none; position: absolute; background-color: white; min-width: 200px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); border-radius: 4px; margin-top: 5px; z-index: 1000;">
                        <a href="{{ route('admin.sources.index') }}" style="display: block; padding: 12px 16px; color: #2c3e50; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#ecf0f1'" onmouseout="this.style.backgroundColor='white'">Sources</a>
                        <a href="{{ route('admin.containings.index') }}" style="display: block; padding: 12px 16px; color: #2c3e50; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#ecf0f1'" onmouseout="this.style.backgroundColor='white'">Contenants</a>
                        <a href="{{ route('admin.admins.index') }}" style="display: block; padding: 12px 16px; color: #2c3e50; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#ecf0f1'" onmouseout="this.style.backgroundColor='white'">Admins</a>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline; margin: 0;">
                    @csrf
                    <button type="submit" style="padding: 8px 16px; font-size: 14px; border: 2px solid #e74c3c; background-color: transparent; color: #e74c3c; border-radius: 4px; cursor: pointer; font-weight: 600; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#e74c3c'; this.style.color='white'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#e74c3c'">
                        Déco
                    </button>
                </form>
            </div>
        </div>

        <!-- Menu mobile (caché par défaut) -->
        <div id="mobile-menu" style="display: none; padding-bottom: 20px;">
            <a href="{{ route('admin.index') }}" style="display: block; padding: 12px 0; color: #ecf0f1; text-decoration: none; border-bottom: 1px solid #34495e;">
                📊 Dashboard
            </a>
            <div style="padding: 12px 0; border-bottom: 1px solid #34495e;">
                <span style="color: #ecf0f1; font-weight: 600;">📦 Stock</span>
                <div style="padding-left: 20px; margin-top: 8px;">
                    <a href="{{ route('admin.items.index') }}" style="display: block; padding: 8px 0; color: #bdc3c7; text-decoration: none;">Items</a>
                    <a href="{{ route('admin.movement.index') }}" style="display: block; padding: 8px 0; color: #bdc3c7; text-decoration: none;">Mouvements</a>
                    <a href="{{ route('admin.attribution.index') }}" style="display: block; padding: 8px 0; color: #bdc3c7; text-decoration: none;">Attributions</a>
                </div>
            </div>
            <div style="padding: 12px 0; border-bottom: 1px solid #34495e;">
                <span style="color: #ecf0f1; font-weight: 600;">⚙️ Configuration</span>
                <div style="padding-left: 20px; margin-top: 8px;">
                    <a href="{{ route('admin.sources.index') }}" style="display: block; padding: 8px 0; color: #bdc3c7; text-decoration: none;">Sources</a>
                    <a href="{{ route('admin.containings.index') }}" style="display: block; padding: 8px 0; color: #bdc3c7; text-decoration: none;">Contenants</a>
                    <a href="{{ route('admin.admins.index') }}" style="display: block; padding: 8px 0; color: #bdc3c7; text-decoration: none;">Admins</a>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: 12px;">
                @csrf
                <button type="submit" style="width: 100%; padding: 12px; border: 2px solid #e74c3c; background-color: transparent; color: #e74c3c; border-radius: 4px; cursor: pointer; font-weight: 600; font-size: 16px;">
                    🚪 Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>

<style>
    @media (max-width: 768px) {
        #desktop-menu {
            display: none !important;
        }
        #burger-btn {
            display: block !important;
        }
    }
</style>

<script>
    function toggleDropdown(menuId) {
        const menu = document.getElementById(menuId);
        const allMenus = document.querySelectorAll('[id$="-menu"]:not(#mobile-menu):not(#desktop-menu)');

        allMenus.forEach(m => {
            if (m.id !== menuId) {
                m.style.display = 'none';
            }
        });

        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }

    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.style.display = mobileMenu.style.display === 'none' ? 'block' : 'none';
    }

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdown') && !event.target.closest('#burger-btn')) {
            document.querySelectorAll('[id$="-menu"]:not(#mobile-menu):not(#desktop-menu)').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });
</script>
