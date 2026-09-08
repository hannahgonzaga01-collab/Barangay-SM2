{{-- ══ DASHBOARD TAB ══ --}}
<div x-show="activeTab === 'dashboard'" x-transition>
    <div class="main-grid">
        <div class="left-col">
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-file-invoice"></i> Document Issuance</div>
                </div>
                @php
                $docs = [
                    ['key'=>'indigency',    'name'=>'Indigency',    'icon'=>'fa-file-signature'],
                    ['key'=>'clearance',    'name'=>'Clearance',    'icon'=>'fa-shield-alt'],
                    ['key'=>'jobseeker',    'name'=>'Job Seeker',   'icon'=>'fa-user-tie'],
                    ['key'=>'business',     'name'=>'Business',     'icon'=>'fa-store'],
                    ['key'=>'residency',    'name'=>'Residency',    'icon'=>'fa-house-user'],
                    ['key'=>'endorsement',  'name'=>'Endorsement',  'icon'=>'fa-file-export'],
                    ['key'=>'moveout',      'name'=>'Move-Out',     'icon'=>'fa-truck-moving'],
                    ['key'=>'movein',       'name'=>'Move-In',      'icon'=>'fa-sign-in-alt'],
                    ['key'=>'closure',      'name'=>'Closure',      'icon'=>'fa-store-slash'],
                    ['key'=>'latereg',      'name'=>'Late Reg',     'icon'=>'fa-clock'],
                    ['key'=>'guardianship', 'name'=>'Guardianship', 'icon'=>'fa-user-shield'],
                    ['key'=>'cohabitation', 'name'=>'Cohabitation', 'icon'=>'fa-user-friends'],
                    ['key'=>'katibayan',    'name'=>'Katibayan',    'icon'=>'fa-stamp'],
                    ['key'=>'cashgift',     'name'=>'Cash Gift',    'icon'=>'fa-gift'],
                    ['key'=>'yumao',        'name'=>'Yumao',        'icon'=>'fa-ribbon'],
                    ['key'=>'oath',         'name'=>'Oath',         'icon'=>'fa-hand-holding-heart'],
                ];
                @endphp
                <div class="doc-grid">
                    @foreach($docs as $doc)
                    <div class="doc-btn" @click="openDoc='{{ $doc['key'] }}'; clearDocOwner()">
                        <div class="doc-ico"><i class="fas {{ $doc['icon'] }}"></i></div>
                        <div class="doc-lbl">{{ $doc['name'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-head">
                    <div class="card-title">
                        <i class="fas fa-star" style="color:#f59e0b;"></i>
                        <span x-text="activeFilter==='birthday'?'Birthday This Month':activeFilter==='senior'?'Senior Citizens':activeFilter==='nonvoter'?'Non Voters':activeFilter==='pwd'?'PWD Residents':activeFilter==='solo'?'Solo Parents':activeFilter==='bedridden'?'Bed-ridden Residents':activeFilter==='household'?'Household Heads':'Recent Residents'"></span>
                    </div>
                    <div class="card-badge" x-text="filteredResidents.slice(0,5).length+' shown'"></div>
                </div>
                <div>
                    <template x-if="filteredResidents.length === 0">
                        <div class="empty-st"><i class="fas fa-users"></i><p>Nothing found</p></div>
                    </template>
                    <template x-for="r in filteredResidents.slice(0,5)" :key="r.id">
                        <div @click="openProfile(r)" class="res-row">
                            <img :src="r.photo||'https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                 x-on:error="$el.src='https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                 class="res-avatar">
                            <div style="flex:1;min-width:0;">
                                <div class="res-name" x-text="r.name"></div>
                                <div class="res-code" x-text="r.code"></div>
                            </div>
                            <div style="display:flex;gap:4px;flex-wrap:wrap;">
                                <span x-show="r.is_senior" class="pill pill-senior">Senior</span>
                                <span x-show="r.is_pwd" class="pill pill-pwd">PWD</span>
                                <span x-show="r.is_bedridden" class="pill pill-pwd" style="background:#fee2e2;color:#dc2626;">Bed-ridden</span>
                                <span x-show="r.is_single_parent" class="pill pill-solo">Solo</span>
                            </div>
                            <i class="fas fa-chevron-right res-chev"></i>
                        </div>
                    </template>
                </div>
                <div x-show="filteredResidents.length > 5">
                    <button @click="activeTab='masterlist'" class="view-all-btn">
                        <i class="fas fa-arrow-right"></i> View All <span x-text="filteredResidents.length"></span> in Masterlist
                    </button>
                </div>
            </div>
        </div>

        <div class="right-col">
            <div class="card">
                <div class="card-head" style="overflow:visible;position:relative;">
                    <div class="card-title"><i class="fas fa-paw" style="color:var(--brand);"></i> Pet Registry</div>
                    @php 
                        $pendingPetVaccinesList = ($pets ?? collect())->where('vaccination_status', 'pending');
                        $pendingPetVaccines = $pendingPetVaccinesList->count(); 
                    @endphp
                    @if($pendingPetVaccines > 0)
                    <div x-data="{ openPetNotif: false }" style="position:relative;">
                        <button @click="openPetNotif = !openPetNotif"
                                style="position:relative;background:none;border:none;cursor:pointer;color:#0E5393;font-size:16px;padding:4px 6px;border-radius:8px;transition:background .15s;"
                                onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='none'"
                                title="{{ $pendingPetVaccines }} pending pet verification(s)">
                            <i class="fas fa-bell"></i>
                            <span style="position:absolute;top:-3px;right:-3px;background:#ef4444;color:#fff;font-size:8px;font-weight:900;min-width:15px;height:15px;border-radius:99px;display:flex;align-items:center;justify-content:center;padding:0 3px;border:1.5px solid #fff;animation:notif-pulse 1.8s infinite;">
                                {{ $pendingPetVaccines }}
                            </span>
                        </button>
                        <div x-show="openPetNotif" @click.away="openPetNotif = false" 
                             style="position:absolute;right:0;top:calc(100% + 8px);width:280px;background:#fff;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.18);border:1px solid #e2e8f0;z-index:999;text-align:left;overflow:hidden;" 
                             x-transition x-cloak>
                            <div style="padding:10px 14px;background:#f8fafc;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;">
                                <span style="font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:.05em;color:var(--brand);"><i class="fas fa-paw"></i> Pending Pet Tasks</span>
                                <span style="font-size:9px;background:#fee2e2;color:#dc2626;padding:2px 7px;border-radius:99px;font-weight:900;">{{ $pendingPetVaccines }} Pending</span>
                            </div>
                            <div style="max-height:260px;overflow-y:auto;">
                                @foreach($pendingPetVaccinesList as $p)
                                <button type="button" @click="openPetNotif = false; goToNotificationTask({ modal: 'petTracker', rowId: 'pet-row-{{ $p->id }}' })" 
                                        style="width:100%;text-align:left;padding:10px 12px;border:none;background:#fff;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;gap:10px;cursor:pointer;transition:background .15s;" 
                                        onmouseover="this.style.background='#eff6ff'" onmouseout="this.style.background='#fff'">
                                    <img src="{{ $p->pet_photo ? asset('storage/'.$p->pet_photo) : 'https://ui-avatars.com/api/?name='.urlencode($p->pet_name??'P').'&background=0E5393&color=fff&bold=true' }}" 
                                         style="width:34px;height:34px;border-radius:8px;object-fit:cover;flex-shrink:0;border:1px solid #ddd;">
                                    <div style="min-width:0;flex:1;">
                                        <div style="font-size:11px;font-weight:800;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                            {{ $p->pet_name }} <span style="font-size:8px;background:#fef3c7;color:#a16207;padding:1px 5px;border-radius:99px;font-weight:800;">Review Vaccine</span>
                                        </div>
                                        <div style="font-size:9px;color:#64748b;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                            Owner: {{ $p->resident->first_name ?? 'N/A' }} {{ $p->resident->last_name ?? '' }}
                                        </div>
                                        <div style="font-size:8px;color:var(--brand);font-weight:700;margin-top:2px;">
                                            {{ $p->created_at ? $p->created_at->diffForHumans() : 'Pending review' }}
                                        </div>
                                    </div>
                                </button>
                                @endforeach
                            </div>
                            <div style="padding:8px 12px;background:#f8fafc;border-top:1px solid #e2e8f0;text-align:center;">
                                <button type="button" @click="openPetNotif = false; goToNotificationTask({ modal: 'petTracker' })" style="background:none;border:none;font-size:10px;font-weight:800;color:var(--brand);cursor:pointer;">
                                    <i class="fas fa-list"></i> Open Full Pet Tracker
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="pet-inner">
                    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:4px;">
                        <div>
                            <div class="pet-lbl">Total Registered</div>
                            <div class="pet-count">{{ ($pets ?? collect())->count() }}</div>
                        </div>
                        <i class="fas fa-paw" style="font-size:34px;color:rgba(14,83,147,.12);"></i>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:7px;margin-top:14px;">
                        <button @click="openPetTracker = true" class="btn-grad btn-grad-sm" style="width:100%;justify-content:center;">
                            <i class="fas fa-list"></i> View Pet Tracker
                        </button>
                        <button @click="openAddPetModal=true; petTypeSelection=''; selectedUser={}; petPhotoPreview=null; vaccineProofPreview=null;" class="btn-grad btn-grad-sm" style="width:100%;justify-content:center;">
                            <i class="fas fa-plus"></i> Add Pet
                        </button>
                        <button @click="openArchivedPetsModal = true" class="btn-plain btn-edit" style="width:100%;justify-content:center;background:#fff;border:1px solid #e2e8f0;color:#475569;font-weight:800;font-size:10px;border-radius:8px;padding:7px 10px;transition:all .15s;" onmouseover="this.style.background='#f1f5f9';this.style.color='#1e293b';" onmouseout="this.style.background='#fff';this.style.color='#475569';">
                            <i class="fas fa-archive" style="color:#d97706;"></i> Archived Pets ({{ ($archivedPets ?? collect())->count() }})
                        </button>
                    </div>
                </div>
            </div>
            <div class="demo-card">
                <div class="demo-title">Demographics</div>
                <div class="demo-row"><span class="demo-lbl">Total Residents</span><span class="demo-val dv-def">{{ $users->count() }}</span></div>
                <div class="demo-row"><span class="demo-lbl">Birthday This Month</span><span class="demo-val dv-pink">{{ $birthdayThisMonth->count() }}</span></div>
                <div class="demo-row"><span class="demo-lbl">Seniors</span><span class="demo-val dv-org">{{ $seniors->count() }}</span></div>
                <div class="demo-row"><span class="demo-lbl">PWD</span><span class="demo-val dv-purp">{{ $pwds->count() }}</span></div>
                <div class="demo-row"><span class="demo-lbl">Bed-ridden</span><span class="demo-val dv-def" style="background:rgba(220,38,38,0.2);color:#dc2626;">{{ $bedridden->count() }}</span></div>
                <div class="demo-row"><span class="demo-lbl">Solo Parents</span><span class="demo-val dv-rose">{{ $soloParents->count() }}</span></div>
                <div class="demo-row"><span class="demo-lbl">Pets</span><span class="demo-val dv-amb">{{ ($pets ?? collect())->count() }}</span></div>
            </div>
        </div>
    </div>
</div>
