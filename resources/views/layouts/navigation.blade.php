<nav x-data="{ open: false }" style="background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/circlelogo.png') }}"
                         class="h-9 w-9 rounded-full object-contain border-2"
                         style="border-color:rgba(255,255,255,.4);"
                         onerror="this.style.display='none'">
                    <span class="font-black text-white text-sm uppercase tracking-widest hidden sm:block">
                        Brgy. San Miguel II
                    </span>
                </div>
            </div>

            @auth
            {{-- Desktop nav links --}}
            <div class="hidden sm:flex items-center gap-2">
                @if(Auth::user()?->role == 'admin')
                    <a href="/admin/dashboard" class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide transition {{ request()->is('admin*') ? 'bg-white text-blue-900' : 'text-white/80 hover:text-white hover:bg-white/15' }}">Dashboard</a>
                    <a href="/office"  class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide transition {{ request()->is('office*')  ? 'bg-white text-blue-900' : 'text-white/80 hover:text-white hover:bg-white/15' }}">Office</a>
                    <a href="/justice" class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide transition {{ request()->is('justice*') ? 'bg-white text-blue-900' : 'text-white/80 hover:text-white hover:bg-white/15' }}">Justice</a>
                    <a href="/vawc"    class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide transition {{ request()->is('vawc*')    ? 'bg-white text-blue-900' : 'text-white/80 hover:text-white hover:bg-white/15' }}">VAWC</a>
                    <a href="/peace"   class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide transition {{ request()->is('peace*')   ? 'bg-white text-blue-900' : 'text-white/80 hover:text-white hover:bg-white/15' }}">Peace & Order</a>
                @endif
                @if(Auth::user()?->role == 'office' && !request()->is('office*'))
                    <a href="/office" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide text-white/80 hover:text-white hover:bg-white/15 transition">
                        <i class="fas fa-arrow-left" style="font-size:10px;"></i> Back to Office Portal
                    </a>
                @endif
                @if(Auth::user()?->role == 'justice' && !request()->is('justice*'))
                    <a href="/justice" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide text-white/80 hover:text-white hover:bg-white/15 transition">
                        <i class="fas fa-arrow-left" style="font-size:10px;"></i> Back to Justice Portal
                    </a>
                @endif
                @if(Auth::user()?->role == 'vawc' && !request()->is('vawc*'))
                    <a href="/vawc" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide text-white/80 hover:text-white hover:bg-white/15 transition">
                        <i class="fas fa-arrow-left" style="font-size:10px;"></i> Back to VAWC Portal
                    </a>
                @endif
                @if(Auth::user()?->role == 'peace' && !request()->is('peace*'))
                    <a href="/peace" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide text-white/80 hover:text-white hover:bg-white/15 transition">
                        <i class="fas fa-arrow-left" style="font-size:10px;"></i> Back to Peace & Order Portal
                    </a>
                @endif
                @if(Auth::user()?->role == 'resident' && !request()->routeIs('resident.index'))
                    <a href="{{ route('resident.index') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide text-white/80 hover:text-white hover:bg-white/15 transition">
                        <i class="fas fa-arrow-left" style="font-size:10px;"></i> Back to Home
                    </a>
                @endif
            </div>
            @endauth

            <div class="flex items-center gap-2">
                @auth
                @php $navUser = Auth::user(); @endphp
                <div class="relative" x-data="{ profileOpen: false }" @click.away="profileOpen=false">
                    <button @click="profileOpen=!profileOpen"
                            class="flex items-center gap-2 rounded-lg transition px-2 py-1.5"
                            style="background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.25);"
                            title="Profile">
                        <img src="{{ $navUser?->photo ? asset('storage/'.$navUser->photo) : 'https://ui-avatars.com/api/?name='.urlencode(($navUser?->first_name??'U').' '.($navUser?->last_name??'')).'&background=0E5393&color=fff&size=64&bold=true' }}"
                             class="w-7 h-7 rounded-full object-cover border"
                             style="border-color:rgba(255,255,255,.4);">
                        <span class="text-white font-bold text-xs hidden sm:block max-w-[120px] truncate">
                            {{ $navUser?->first_name ?? $navUser?->name ?? 'Profile' }}
                        </span>
                        <i class="fas fa-chevron-down" style="font-size:9px;color:rgba(255,255,255,.7);"
                           :style="profileOpen?'transform:rotate(180deg);transition:.2s':''"></i>
                    </button>

                    <div x-show="profileOpen" x-cloak x-transition
                         class="absolute right-0 mt-2 w-64 rounded-xl shadow-2xl border overflow-hidden"
                         style="background:#fff;border-color:#e2e8f0;z-index:9999;">

                        <div class="px-4 py-3" style="background:linear-gradient(135deg,#000052 0%,#0E5393 100%);">
                            <div class="flex items-center gap-3">
                                <img src="{{ $navUser?->photo ? asset('storage/'.$navUser->photo) : 'https://ui-avatars.com/api/?name='.urlencode(($navUser?->first_name??'U').' '.($navUser?->last_name??'')).'&background=ffffff&color=0E5393&size=64&bold=true' }}"
                                     class="w-10 h-10 rounded-xl object-cover" style="border:2px solid rgba(255,255,255,.4);">
                                <div>
                                    <div class="text-white font-black text-sm leading-tight">{{ ($navUser?->first_name??'').' '.($navUser?->last_name??($navUser?->name??'')) }}</div>
                                    <div class="text-[10px] font-bold uppercase tracking-wide mt-0.5" style="color:rgba(255,255,255,.6);">
                                        {{ ucfirst($navUser?->role ?? 'User') }}
                                        @if($navUser?->resident_code) • {{ $navUser->resident_code }} @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-1">
                            @if($navUser?->role === 'resident')
                            <a href="{{ route('resident.index') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-home w-4 text-center" style="color:#0E5393;"></i> Home / Portal
                            </a>
                            <button
                                @click="profileOpen=false"
                                onclick="setTimeout(()=>window.dispatchEvent(new CustomEvent('open-profile-modal')),150)"
                                class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition text-left">
                                <i class="fas fa-user-circle w-4 text-center" style="color:#0E5393;"></i> My Profile
                            </button>
                            @endif

                            @if($navUser?->role === 'admin')
                            <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-tachometer-alt w-4 text-center" style="color:#0E5393;"></i> Admin Dashboard
                            </a>
                            <a href="/office" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-building w-4 text-center" style="color:#0E5393;"></i> Office Portal
                            </a>
                            <a href="/justice" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-gavel w-4 text-center" style="color:#0E5393;"></i> Justice Portal
                            </a>
                            <a href="/vawc" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-shield-alt w-4 text-center" style="color:#0E5393;"></i> VAWC Portal
                            </a>
                            <a href="/peace" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-balance-scale w-4 text-center" style="color:#0E5393;"></i> Peace & Order
                            </a>
                            @endif

                            @if($navUser?->role === 'office')
                            <a href="/office" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-building w-4 text-center" style="color:#0E5393;"></i> Office Portal
                            </a>
                            @endif
                            @if($navUser?->role === 'justice')
                            <a href="/justice" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-gavel w-4 text-center" style="color:#0E5393;"></i> Justice Portal
                            </a>
                            @endif
                            @if($navUser?->role === 'peace')
                            <a href="/peace" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-shield w-4 text-center" style="color:#0E5393;"></i> Peace & Order Portal
                            </a>
                            @endif

                            <div style="height:1px;background:#f1f5f9;margin:4px 0;"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-red-600 hover:bg-red-50 transition text-left">
                                    <i class="fas fa-sign-out-alt w-4 text-center"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- HAMBURGER — show for ALL roles on mobile --}}
                <button @click="open=!open"
                        class="sm:hidden flex items-center justify-center w-8 h-8 rounded-lg transition"
                        style="background:rgba(255,255,255,.12);color:#fff;">
                    <i class="fas" :class="open ? 'fa-times' : 'fa-bars'" style="font-size:13px;"></i>
                </button>

                @else
                {{-- Guest --}}
                <div class="relative" x-data="{ guestOpen: false }" @click.away="guestOpen=false">
                    <button @click="guestOpen=!guestOpen"
                            class="flex items-center justify-center w-9 h-9 rounded-full transition"
                            style="background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.35);"
                            title="Login / Register">
                        <i class="fas fa-user-circle" style="color:#fff;font-size:18px;"></i>
                    </button>
                    <div x-show="guestOpen" x-cloak x-transition
                         class="absolute right-0 mt-2 w-52 rounded-xl shadow-2xl border overflow-hidden"
                         style="background:#fff;border-color:#e2e8f0;z-index:9999;">
                        <div class="px-4 py-3 border-b" style="background:#f8fafc;border-color:#e2e8f0;">
                            <p class="text-xs font-black text-gray-700 uppercase tracking-wide">Welcome!</p>
                            <p class="text-[10px] text-gray-500 font-semibold mt-0.5">Sign in to access your account</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('login') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-sign-in-alt w-4 text-center" style="color:#0E5393;"></i> Login
                            </a>
                            <a href="{{ route('register') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-user-plus w-4 text-center" style="color:#0E5393;"></i> Create Account
                            </a>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>

    {{-- MOBILE DROPDOWN — ALL authenticated roles --}}
    @auth
    <div x-show="open" x-cloak x-transition class="sm:hidden border-t" style="border-color:rgba(255,255,255,.15);background:rgba(0,0,30,.4);backdrop-filter:blur(8px);">
        <div class="px-4 py-3 space-y-1">
            @if(Auth::user()?->role === 'admin')
                <a href="/admin/dashboard" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-tachometer-alt" style="width:16px;text-align:center;"></i> Admin Dashboard
                </a>
                <a href="/office"  class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-building" style="width:16px;text-align:center;"></i> Office Portal
                </a>
                <a href="/justice" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-gavel" style="width:16px;text-align:center;"></i> Justice Portal
                </a>
                <a href="/vawc"    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-shield-alt" style="width:16px;text-align:center;"></i> VAWC Portal
                </a>
                <a href="/peace"   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-balance-scale" style="width:16px;text-align:center;"></i> Peace & Order
                </a>
            @elseif(Auth::user()?->role === 'office')
                <a href="/office" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-building" style="width:16px;text-align:center;"></i> Office Portal
                </a>
            @elseif(Auth::user()?->role === 'justice')
                <a href="/justice" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-gavel" style="width:16px;text-align:center;"></i> Justice Portal
                </a>
            @elseif(Auth::user()?->role === 'vawc')
                <a href="/vawc" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-shield-alt" style="width:16px;text-align:center;"></i> VAWC Portal
                </a>
            @elseif(Auth::user()?->role === 'peace')
                <a href="/peace" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-balance-scale" style="width:16px;text-align:center;"></i> Peace & Order Portal
                </a>
            @elseif(Auth::user()?->role === 'resident')
                <a href="{{ route('resident.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-home" style="width:16px;text-align:center;"></i> Home
                </a>
            @endif
            <div style="height:1px;background:rgba(255,255,255,.1);margin:6px 0;"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-red-300 hover:bg-red-900/30 hover:text-red-200 transition text-left">
                    <i class="fas fa-sign-out-alt" style="width:16px;text-align:center;"></i> Logout
                </button>
            </form>
        </div>
    </div>
    @endauth

</nav>
