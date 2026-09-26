{{-- ══ ARCHIVED RESIDENTS TAB ══ --}}
<div x-show="activeTab === 'archived'" x-transition x-data="{ searchArchivedRes: '', filterArchivedResGender: '', filterArchivedResClass: '' }">
    <div class="card">
        <div class="card-head" style="flex-wrap:wrap;gap:10px;">
            <div class="card-title">
                <i class="fas fa-archive" style="color:#d97706;"></i> Archived Residents Masterlist
            </div>
            <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                <span class="card-badge" style="background:#fef3c7;color:#d97706;">{{ $archivedResidentsCount ?? 0 }} Archived</span>
                <button type="button" @click="activeTab='masterlist'"
                        class="btn-plain btn-sm"
                        style="padding:6px 12px; font-size:10px; font-weight:800; background:#fff; border:1.5px solid var(--border); color:#0E5393; border-radius:var(--r-btn); cursor:pointer; display:inline-flex; align-items:center; gap:5px;"
                        title="Return to Active Resident Masterlist">
                    <i class="fas fa-arrow-left"></i> <span>Back to Masterlist</span>
                </button>
                <a href="/office/export?filter=archived"
                   class="btn-grad btn-grad-sm"
                   style="background:linear-gradient(135deg,#d97706 0%,#b45309 100%); box-shadow:0 2px 6px rgba(217,119,6,.3); padding:6px 13px; font-weight:800; font-size:10px; text-decoration:none; display:inline-flex; align-items:center; gap:6px; color:#fff; border-radius:var(--r-btn);"
                   title="Export Archived Residents to CSV">
                    <i class="fas fa-file-csv"></i> <span>Export CSV</span>
                </a>
            </div>
        </div>

        {{-- Filter & Search Toolbar inside Archived Residents --}}
        <div style="padding:12px 16px;background:#f8fafc;border-bottom:1px solid var(--border);display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
            <div style="flex:1;min-width:200px;position:relative;">
                <i class="fas fa-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:11px;"></i>
                <input type="text" x-model="searchArchivedRes" placeholder="Search archived resident by name or code..."
                       style="width:100%;padding:7px 12px 7px 30px;background:#fff;border:1.5px solid var(--border);border-radius:8px;font-size:11px;font-weight:600;outline:none;">
            </div>
            <select x-model="filterArchivedResGender" class="finput fselect" style="width:auto;font-size:11px;padding:6px 12px;">
                <option value="">All Genders</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <select x-model="filterArchivedResClass" class="finput fselect" style="width:auto;font-size:11px;padding:6px 12px;">
                <option value="">All Classifications</option>
                <option value="is_senior">Seniors</option>
                <option value="is_pwd">PWD</option>
                <option value="is_single_parent">Solo Parent</option>
                <option value="is_non_voter">Non-Voters</option>
                <option value="is_bedridden">Bed-ridden</option>
            </select>
        </div>

        <div style="overflow-x:auto;">
            <table class="res-table master-tbl">
                <thead>
                    <tr>
                        <th style="width:50px;text-align:center;">Photo</th>
                        <th>Resident Details</th>
                        <th>Classification</th>
                        <th>Archived Date & Reason</th>
                        <th style="text-align:right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($archivedResidents ?? [] as $ar)
                    @php
                        $arName = trim(($ar->first_name ?? '') . ' ' . ($ar->last_name ?? ''));
                    @endphp
                    <tr x-show="(!searchArchivedRes || '{{ strtolower($arName . ' ' . ($ar->resident_code ?? '')) }}'.includes(searchArchivedRes.toLowerCase())) &&
                                (!filterArchivedResGender || '{{ $ar->gender }}' === filterArchivedResGender) &&
                                (!filterArchivedResClass || '{{ $ar->is_senior ? 'is_senior' : ($ar->is_pwd ? 'is_pwd' : ($ar->is_single_parent ? 'is_single_parent' : ($ar->is_non_voter ? 'is_non_voter' : ($ar->is_bedridden ? 'is_bedridden' : '')))) }}' === filterArchivedResClass)"
                        style="transition:all .15s;">
                        <td style="text-align:center;">
                            <img src="{{ $ar->photo ? asset('storage/' . $ar->photo) : 'https://ui-avatars.com/api/?name='.urlencode($arName).'&background=64748B&color=fff&bold=true&rounded=true' }}"
                                 style="width:36px;height:36px;border-radius:9px;object-fit:cover;border:2px solid #fff;box-shadow:0 1px 4px rgba(0,0,0,.1);display:block;margin:0 auto;filter:grayscale(60%);">
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:6px;">
                                <div class="res-name" style="color:#475569;">{{ $arName }}</div>
                                <span class="pill" style="background:#fee2e2;color:#dc2626;font-size:8px;">Archived</span>
                            </div>
                            <div class="res-code">{{ $ar->resident_code ?? 'NO-CODE' }} • {{ $ar->contact_number ?: 'No contact' }}</div>
                            <div style="font-size:10px;color:var(--muted);margin-top:2px;">{{ $ar->address ?: 'No address' }}</div>
                        </td>
                        <td>
                            <div style="display:flex;gap:4px;flex-wrap:wrap;">
                                @if($ar->is_senior)<span class="pill pill-senior">Senior</span>@endif
                                @if($ar->is_pwd)<span class="pill pill-pwd">PWD</span>@endif
                                @if($ar->is_single_parent)<span class="pill pill-solo">Solo</span>@endif
                                @if($ar->is_voter)<span class="pill pill-voter">Voter</span>@endif
                                @if($ar->is_non_voter)<span class="pill" style="background:#fef3c7;color:#a16207;font-size:8px;">Non-Voter</span>@endif
                                @if($ar->is_bedridden)<span class="pill" style="background:#fee2e2;color:#dc2626;font-size:8px;">Bed-ridden</span>@endif
                            </div>
                        </td>
                        <td>
                            <div style="font-size:11px;font-weight:700;color:#0f172a;">
                                <i class="fas fa-calendar-alt" style="color:#94a3b8;font-size:10px;"></i>
                                {{ $ar->archived_at ? \Carbon\Carbon::parse($ar->archived_at)->format('M d, Y • h:i A') : ($ar->updated_at ? $ar->updated_at->format('M d, Y') : '-') }}
                            </div>
                            <div style="font-size:10px;color:#d97706;font-weight:600;margin-top:2px;">
                                <i class="fas fa-info-circle"></i> {{ $ar->archive_reason ?: 'Archived by staff' }}
                            </div>
                        </td>
                        <td style="text-align:right;">
                            <form action="{{ route('office.restore', $ar->id) }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-plain btn-green" style="padding:6px 12px;font-size:10px;gap:5px;box-shadow:0 1px 3px rgba(0,0,0,0.1);" title="Restore resident to active Masterlist">
                                    <i class="fas fa-undo"></i> Restore Resident
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-st" style="padding:36px;">
                                <i class="fas fa-archive" style="font-size:32px;color:#cbd5e1;"></i>
                                <p style="font-size:12px;color:var(--muted);font-weight:700;">No archived residents found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
