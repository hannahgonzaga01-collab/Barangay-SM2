<nav x-data="{ open: false }" style="background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">

            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="flex items-center gap-3 transition-opacity hover:opacity-90" title="Barangay San Miguel II">
                    <img src="{{ asset('images/circlelogo.png') }}"
                         class="h-10 w-10 sm:h-11 sm:w-11 rounded-full object-contain border-2 shadow-sm"
                         style="border-color:rgba(255,255,255,.45);"
                         onerror="this.style.display='none'">
                    <span class="font-black text-white text-sm sm:text-base uppercase tracking-widest hidden sm:block">
                        Brgy. San Miguel II
                    </span>
                </a>
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
            </div>
            @endauth

            <div class="flex items-center gap-2">
                @if(request()->is('resident*') || request()->is('/'))
                {{-- Language Toggle EN | FIL --}}
                <div class="flex items-center rounded-lg p-0.5 border" style="background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.25);"
                     x-data="{ currentLang: localStorage.getItem('resident_lang') || 'en' }"
                     x-on:lang-changed.window="currentLang = $event.detail">
                    <button type="button" 
                            @click="currentLang = 'en'; localStorage.setItem('resident_lang', 'en'); window.dispatchEvent(new CustomEvent('lang-changed', {detail: 'en'}));"
                            :class="currentLang === 'en' ? 'bg-white text-blue-950 font-black shadow-sm' : 'text-white/80 font-bold hover:text-white'"
                            class="px-2 py-1 rounded text-[10px] tracking-wider transition">
                        EN
                    </button>
                    <span class="text-white/40 text-[10px] mx-0.5">|</span>
                    <button type="button" 
                            @click="currentLang = 'fil'; localStorage.setItem('resident_lang', 'fil'); window.dispatchEvent(new CustomEvent('lang-changed', {detail: 'fil'}));"
                            :class="currentLang === 'fil' ? 'bg-white text-blue-950 font-black shadow-sm' : 'text-white/80 font-bold hover:text-white'"
                            class="px-2 py-1 rounded text-[10px] tracking-wider transition">
                        FIL
                    </button>
                </div>
                @endif
                @auth
                @php
                    $navUser = Auth::user();
                    $navUnreadCount = $navUser->unreadNotifications()->count();
                    $navNotifications = $navUser->notifications()->latest()->take(10)->get();
                @endphp
                {{-- Notification Bell (Between Language Toggle and User Profile) --}}
                <div class="relative" x-data="{ notifOpen: false }" @click.away="notifOpen=false">
                    <button @click="notifOpen=!notifOpen; if(notifOpen) { fetch('{{ route('resident.notifications.read') }}', { method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'} }); }"
                            class="relative flex items-center justify-center w-8 h-8 rounded-lg transition"
                            style="background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.25);color:#fff;"
                            title="Notifications">
                        <i class="fas fa-bell text-xs"></i>
                        @if($navUnreadCount > 0)
                        <span class="absolute -top-1.5 -right-1.5 bg-red-600 text-white font-black text-[9px] min-w-[16px] h-4 rounded-full flex items-center justify-center border-2 border-slate-900 px-1">
                            {{ $navUnreadCount }}
                        </span>
                        @endif
                    </button>

                    <div x-show="notifOpen" x-cloak x-transition
                         class="absolute right-0 mt-2 w-72 sm:w-80 rounded-xl shadow-2xl border overflow-hidden bg-white"
                         style="border-color:#e2e8f0;z-index:9999;">
                        <div class="px-3.5 py-2.5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                            <span class="text-xs font-black text-slate-800 uppercase tracking-wide">Notifications</span>
                            @if($navUnreadCount > 0)
                            <span class="text-[9px] bg-red-100 text-red-600 font-extrabold px-2 py-0.5 rounded-full">{{ $navUnreadCount }} unread</span>
                            @endif
                        </div>
                        <div class="max-h-72 overflow-y-auto">
                            @forelse($navNotifications as $notif)
                            @php 
                                $isUnread = is_null($notif->read_at); 
                                $type = $notif->data['type'] ?? '';
                                $targetId = (str_contains($type, 'sos')) ? 'sos-history' : ((str_contains($type, 'document') || str_contains($type, 'reminder') || str_contains($type, 'appointment')) ? 'application-history' : 'incident-reports');
                            @endphp
                            <div class="flex items-start gap-2.5 px-3.5 py-2.5 border-b border-slate-100 hover:bg-slate-50 cursor-pointer transition {{ $isUnread ? 'bg-blue-50/60' : '' }}"
                                 @click="notifOpen=false; document.getElementById('{{ $targetId }}')?.scrollIntoView({behavior:'smooth'})">
                                <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ $isUnread ? (str_contains($type, 'sos') ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-700') : 'bg-slate-100 text-slate-400' }}">
                                    <i class="fas {{ str_contains($type, 'sos') ? 'fa-ambulance' : (str_contains($type, 'reminder') || str_contains($type, 'appointment') ? 'fa-clock' : ($type === 'document_received' ? 'fa-file-alt' : 'fa-bell')) }} text-xs"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-bold text-slate-800 leading-tight">{{ $notif->data['title'] ?? 'Notification' }}</div>
                                    <div class="text-[11px] text-slate-600 font-medium mt-0.5 line-clamp-2 leading-snug">{{ $notif->data['message'] ?? '' }}</div>
                                    <div class="text-[9px] text-slate-400 font-semibold mt-1">{{ $notif->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            @empty
                            <div class="py-7 text-center text-slate-400">
                                <i class="fas fa-bell text-xl block mb-1.5 opacity-30"></i>
                                <p class="text-xs font-bold">No notifications yet.</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="px-3 py-2 text-center bg-slate-50 border-t border-slate-200">
                            <span class="text-[10px] text-slate-500 font-medium">Notifications are cleared after 30 days.</span>
                        </div>
                    </div>
                </div>

                <div class="relative" x-data="{ profileOpen: false }" @click.away="profileOpen=false">
                    <button @click="profileOpen=!profileOpen"
                            class="flex items-center gap-2 rounded-lg transition px-2 py-1.5"
                            style="background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.25);"
                            title="Profile">
                        @php
                            $navUserName = trim(($navUser?->first_name ?? '') . ' ' . ($navUser?->last_name ?? '')) ?: ($navUser?->name ?? 'User');
                            $navAvatarFallback = 'https://ui-avatars.com/api/?name=' . urlencode($navUserName) . '&background=0E5393&color=fff&size=128&bold=true';
                        @endphp
                        <img src="{{ $navUser?->profile_photo_url ?? $navAvatarFallback }}"
                             onerror="this.onerror=null; this.src='{{ $navAvatarFallback }}';"
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
                                <img src="{{ $navUser?->profile_photo_url ?? $navAvatarFallback }}"
                                     onerror="this.onerror=null; this.src='{{ $navAvatarFallback }}';"
                                     class="w-10 h-10 rounded-xl object-cover" style="border:2px solid rgba(255,255,255,.4);">
                                <div>
                                    <div class="text-white font-black text-sm leading-tight">
                                        {{ trim(($navUser?->first_name ?? '') . ' ' . ($navUser?->last_name ?? '')) ?: ($navUser?->name ?? 'User') }}
                                    </div>
                                    <div class="text-[10px] font-bold uppercase tracking-wide mt-0.5" style="color:rgba(255,255,255,.6);">
                                        {{ $navUser?->role === 'peace' ? 'Peace Staff' : ($navUser?->role === 'office' ? 'Office Staff' : ($navUser?->role === 'vawc' ? 'VAWC Staff' : ($navUser?->role === 'justice' ? 'Justice Officer' : ucfirst($navUser?->role ?? 'User')))) }}
                                        @if($navUser?->resident_code) • {{ $navUser->resident_code }} @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-1">
                            @if($navUser?->role === 'resident')
                            <a href="{{ route('staff.password.show') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fas fa-key w-4 text-center" style="color:#0E5393;"></i> Change Password
                            </a>
                            <button
                                @click="profileOpen=false"
                                onclick="setTimeout(()=>window.dispatchEvent(new CustomEvent('open-profile-modal')),150)"
                                class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition text-left">
                                <i class="fas fa-user-circle w-4 text-center" style="color:#0E5393;"></i> My Profile
                            </button>
                            @endif



                            @if($navUser?->role === 'office')
                            <div class="px-4 py-3 bg-blue-50/50 border-t border-gray-100" x-data="{
                                navIssuedBy: localStorage.getItem('brgy_office_issued_by') || '',
                                navPosition: localStorage.getItem('brgy_office_position') || '',
                                saved: false,
                                saveSettings() {
                                    localStorage.setItem('brgy_office_issued_by', this.navIssuedBy);
                                    localStorage.setItem('brgy_office_position', this.navPosition);
                                    window.dispatchEvent(new CustomEvent('update-office-settings', { detail: { issuedBy: this.navIssuedBy, position: this.navPosition } }));
                                    this.saved = true;
                                    setTimeout(() => this.saved = false, 2000);
                                }
                            }" @update-office-settings.window="if(navIssuedBy !== $event.detail.issuedBy) navIssuedBy = $event.detail.issuedBy; if(navPosition !== $event.detail.position) navPosition = $event.detail.position;">
                                <div class="text-[9px] font-black uppercase text-blue-800 mb-2 tracking-widest"><i class="fas fa-user-clock mr-1"></i> Duty Staff</div>
                                <div class="mb-2">
                                    <label class="text-[9px] font-bold text-gray-500 block mb-1 uppercase tracking-wide">Staff Name</label>
                                    <input type="text" x-model="navIssuedBy" @keydown.enter="saveSettings()" class="w-full px-2 py-1.5 text-xs bg-white border border-gray-200 rounded-md outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all shadow-sm" placeholder="e.g. Juan Dela Cruz">
                                </div>
                                <div class="mb-2">
                                    <label class="text-[9px] font-bold text-gray-500 block mb-1 uppercase tracking-wide">Position</label>
                                    <input type="text" x-model="navPosition" @keydown.enter="saveSettings()" class="w-full px-2 py-1.5 text-xs bg-white border border-gray-200 rounded-md outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all shadow-sm" placeholder="e.g. Barangay Staff">
                                </div>
                                <button type="button" @click="saveSettings()" class="w-full py-1.5 rounded-md text-[10px] font-bold tracking-wider text-white uppercase transition-all shadow-sm hover:shadow-md" style="background:linear-gradient(135deg, #0E5393 0%, #04192D 100%);">
                                    <span x-show="!saved">Save Changes</span>
                                    <span x-show="saved" x-cloak><i class="fas fa-check text-green-400"></i> Saved!</span>
                                </button>
                            </div>
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

                {{-- HAMBURGER — hide for residents (they use profile dropdown) --}}
                @if(Auth::user()?->role !== 'resident')
                <button @click="open=!open"
                        class="sm:hidden flex items-center justify-center w-8 h-8 rounded-lg transition"
                        style="background:rgba(255,255,255,.12);color:#fff;">
                    <i class="fas" :class="open ? 'fa-times' : 'fa-bars'" style="font-size:13px;"></i>
                </button>
                @endif

                @else
                {{-- Guest Login Button --}}
                <div class="relative" x-data="{ guestOpen: false }" @click.away="guestOpen=false">
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('login') }}"
                           class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-wider text-white transition hover:bg-white/25 border shadow-sm"
                           style="background:rgba(255,255,255,.15);border-color:rgba(255,255,255,.35);"
                           title="Login to Barangay Portal">
                            <i class="fas fa-user" style="font-size:12px;"></i>
                            <span>Login</span>
                        </a>
                        <button type="button" @click="guestOpen=!guestOpen"
                                class="flex items-center justify-center w-7 h-7 rounded-lg transition hover:bg-white/20 text-white/80"
                                title="More account options">
                            <i class="fas fa-chevron-down text-[9px]" :style="guestOpen?'transform:rotate(180deg);transition:.2s':''"></i>
                        </button>
                    </div>

                    <div x-show="guestOpen" x-cloak x-transition
                         class="absolute right-0 mt-2 w-52 rounded-xl shadow-2xl border overflow-hidden"
                         style="background:#fff;border-color:#e2e8f0;z-index:9999;">
                        <div class="px-4 py-3 border-b" style="background:#f8fafc;border-color:#e2e8f0;">
                            <p class="text-xs font-black text-gray-700 uppercase tracking-wide">Welcome!</p>
                            <p class="text-[10px] text-gray-500 font-semibold mt-0.5">Sign in or register your account</p>
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
                <a href="{{ route('staff.password.show') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold uppercase text-white/80 hover:bg-white/15 hover:text-white transition">
                    <i class="fas fa-key" style="width:16px;text-align:center;"></i> Change Password
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
