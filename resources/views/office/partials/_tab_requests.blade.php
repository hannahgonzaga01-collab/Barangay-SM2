{{-- ══ DOCUMENT REQUESTS TAB ══ --}}
@php
    $statusColors = [
        'pending'    => ['bg'=>'#fef3c7','color'=>'#a16207','icon'=>'fa-clock'],
        'processing' => ['bg'=>'#dbeafe','color'=>'#1d4ed8','icon'=>'fa-spinner'],
        'ready'      => ['bg'=>'#dcfce7','color'=>'#15803d','icon'=>'fa-check-circle'],
        'released'   => ['bg'=>'#f1f5f9','color'=>'#64748b','icon'=>'fa-box-open'],
        'disapproved' => ['bg'=>'#fee2e2','color'=>'#dc2626','icon'=>'fa-times-circle'],
    ];
@endphp
<div x-show="activeTab === 'requests'" x-transition>
    @if(isset($digitalIdRequests) && $digitalIdRequests->count() > 0)
    <div class="card" style="margin-bottom:16px;">
        <div class="card-head">
            <div class="card-title"><i class="fas fa-id-card" style="color:var(--brand);"></i> Digital ID Requests</div>
            <span class="card-badge" style="background:#fef3c7;color:#a16207;">{{ $digitalIdRequests->count() }} Pending</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="res-table">
                <thead><tr>
                    <th style="text-align:left;width:220px;">Resident</th>
                    <th>Date Requested</th>
                    <th>Emergency Contact</th>
                    <th style="text-align:right;">Action</th>
                </tr></thead>
                <tbody>
                    @foreach($digitalIdRequests as $idReq)
                    @php
                        $idUser = $idReq->user;
                        $idName = $idUser
                            ? trim(($idUser->first_name ?? '') . ' ' . ($idUser->last_name ?? '')) ?: ($idUser->name ?? $idUser->email ?? 'Unknown')
                            : 'Unknown Resident';
                        $idCode = $idUser?->resident_code ?? '—';
                    @endphp
                    <tr id="id-req-{{ $idReq->id }}" style="transition: background-color 0.5s;">
                        <td data-label="Resident">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <img src="{{ $idUser?->photo ? asset('storage/'.$idUser->photo) : 'https://ui-avatars.com/api/?name='.urlencode($idName).'&background=0E5393&color=fff&size=64&bold=true' }}"
                                     style="width:36px;height:36px;border-radius:9px;object-fit:cover;flex-shrink:0;">
                                <div>
                                    <div style="font-size:12px;font-weight:800;color:#0f172a;">{{ $idName }}</div>
                                    <div style="font-size:10px;color:var(--muted);font-weight:600;">{{ $idCode }}</div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Requested At">
                            <div style="font-size:10px;color:var(--muted);font-weight:600;white-space:nowrap;">{{ $idReq->created_at->format('M d, Y') }}</div>
                            <div style="font-size:9px;color:var(--light);">{{ $idReq->created_at->diffForHumans() }}</div>
                        </td>
                        <td data-label="Emergency Contact">
                            <div style="font-size:11px;font-weight:700;color:var(--text);">{{ $idReq->contact_person ?? '—' }}</div>
                            <div style="font-size:10px;color:var(--muted);font-weight:600;">{{ $idReq->contact_person_number ?? '' }}</div>
                        </td>
                        <td style="text-align:right;">
                            <form action="{{ route('office.digital.id.generate', $idReq->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-grad btn-grad-sm">
                                    <i class="fas fa-id-card"></i> Generate ID
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    @if(isset($pendingVoters) && $pendingVoters->count() > 0)
    <div class="card" style="margin-bottom:16px;">
        <div class="card-head">
            <div class="card-title"><i class="fas fa-user-check" style="color:var(--brand);"></i> Voter ID Verifications</div>
            <span class="card-badge" style="background:#fee2e2;color:#dc2626;">{{ $pendingVoters->count() }} Pending</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="res-table">
                <thead><tr>
                    <th style="text-align:left;width:220px;">Resident</th>
                    <th>Date Requested</th>
                    <th>Photo ID</th>
                    <th style="text-align:right;">Action</th>
                </tr></thead>
                <tbody>
                    @foreach($pendingVoters as $pv)
                    <tr x-data="{ openDecline: false, reasonSelect: '', reasonCustom: '' }" id="voter-req-{{ $pv->id }}" style="transition: background-color 0.5s;">
                        <td data-label="Resident">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <img src="{{ $pv->photo ? asset('storage/'.$pv->photo) : 'https://ui-avatars.com/api/?name='.urlencode($pv->first_name.' '.$pv->last_name).'&background=0E5393&color=fff&size=64&bold=true' }}"
                                     style="width:36px;height:36px;border-radius:99px;object-fit:cover;flex-shrink:0;">
                                <div>
                                    <div style="font-size:12px;font-weight:800;color:#0f172a;">{{ $pv->first_name }} {{ $pv->last_name }}</div>
                                    <div style="font-size:10px;color:var(--muted);font-weight:600;">{{ $pv->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Requested At">
                            <div style="font-size:10px;color:var(--muted);font-weight:600;white-space:nowrap;">{{ $pv->created_at->format('M d, Y') }}</div>
                            <div style="font-size:9px;color:var(--light);">{{ $pv->created_at->diffForHumans() }}</div>
                        </td>
                        <td data-label="Photo ID">
                            @if($pv->voter_id_photo)
                            <button type="button" onclick="viewPhoto('{{ asset('storage/'.$pv->voter_id_photo) }}')" style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;background:#f1f5f9;border-radius:4px;font-size:10px;font-weight:700;color:var(--brand);border:none;cursor:pointer;"><i class="fas fa-image"></i> View ID</button>
                            @else
                            <span style="font-size:9px;color:var(--light);font-weight:600;background:#f1f5f9;padding:4px 8px;border-radius:4px;">No ID Uploaded</span>
                            @endif
                        </td>
                        <td data-label="Action" style="text-align:right;">
                            <div x-show="!openDecline" style="display:flex;justify-content:flex-end;gap:5px;">
                                <form action="{{ route('office.voter.approve', $pv->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-grad btn-grad-sm" style="background:var(--success);box-shadow:none;">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                <button @click="openDecline=true" type="button" class="btn-grad btn-grad-sm" style="background:#fee2e2;color:var(--danger);box-shadow:none;">
                                    <i class="fas fa-times"></i> Decline
                                </button>
                            </div>
                            <div x-show="openDecline" x-transition style="margin-top:5px;text-align:left;" x-cloak>
                                <form action="{{ route('office.voter.decline', $pv->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="reason" :value="reasonSelect === 'Others' ? reasonCustom : reasonSelect">
                                    <select x-model="reasonSelect" required class="finput fselect" style="font-size:10px;padding:6px;width:100%;margin-bottom:4px;">
                                        <option value="">— Select Reason —</option>
                                        <option value="Unclear / Blurry Voter ID Photo">Unclear / Blurry Voter ID Photo</option>
                                        <option value="Name Mismatch with Barangay / COMELEC Records">Name Mismatch with Barangay / COMELEC Records</option>
                                        <option value="Invalid / Non-Voter ID Document">Invalid / Non-Voter ID Document</option>
                                        <option value="Others">Others (Please specify)</option>
                                    </select>
                                    <div x-show="reasonSelect === 'Others'" x-transition>
                                        <textarea x-model="reasonCustom" :required="reasonSelect === 'Others'" rows="2" class="finput" style="font-size:10px;padding:6px;width:100%;resize:none;margin-bottom:4px;" placeholder="Specify reason for declining..."></textarea>
                                    </div>
                                    <div style="display:flex;justify-content:flex-end;gap:5px;">
                                        <button @click="openDecline=false" type="button" class="btn-plain btn-edit" style="padding:4px 8px;font-size:9px;">Cancel</button>
                                        <button type="submit" class="btn-grad btn-grad-sm" style="background:var(--danger);box-shadow:none;padding:4px 8px;font-size:9px;">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <div class="card">
        <div class="card-head" style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:nowrap;">
            <div class="card-title" style="white-space:nowrap; flex-shrink:0;"><i class="fas fa-file-alt"></i> All Document Requests</div>
            <div style="display:flex; align-items:center; gap:8px; flex-shrink:0;">
                {{-- Status Dropdown Filter --}}
                <select x-model="docStatusFilter" class="fselect" style="font-size:10px; font-weight:800; height:28px; padding:0 8px; border-radius:8px; border:1.5px solid var(--border); background:#fff; color:var(--text); outline:none; cursor:pointer; width:auto;">
                    <option value="all">🔍 Active Requests</option>
                    <option value="pending">⏳ Pending</option>
                    <option value="processing">🔄 Processing</option>
                    <option value="ready">✅ Ready for Pickup</option>
                    <option value="released">📦 Released</option>
                    <option value="disapproved">❌ Rejected / Disapproved</option>
                </select>

                {{-- Date Filter Group --}}
                <div class="filter-group" style="display:flex; background:#f1f5f9; padding:2px; border-radius:8px; flex-shrink:0; height:28px; align-items:center;">
                    <button @click="docFilter='all'" :class="docFilter==='all' ? 'active-filter' : 'plain-filter'">All</button>
                    <button @click="docFilter='today'" :class="docFilter==='today' ? 'active-filter' : 'plain-filter'">Today</button>
                </div>

                {{-- Dedicated Archive Quick Button --}}
                <button type="button" @click="docStatusFilter = (docStatusFilter === 'released_archive' ? 'all' : 'released_archive')"
                        :style="docStatusFilter === 'released_archive' ? 'background:#0E5393; color:#fff; border-color:#0E5393;' : 'background:#fff; color:#475569; border-color:#cbd5e1;'"
                        style="height:28px; padding:0 10px; font-size:9.5px; font-weight:800; border-radius:8px; border:1.5px solid; cursor:pointer; display:inline-flex; align-items:center; gap:5px; transition:all 0.15s; white-space:nowrap; flex-shrink:0;"
                        title="Archived Documents">
                    <i class="fas fa-archive" style="font-size:10px;"></i>
                    <span x-text="docStatusFilter === 'released_archive' ? 'Active' : 'Archived'"></span>
                    <span style="padding:1px 5px; border-radius:99px; font-size:8.5px; font-weight:900;"
                          :style="docStatusFilter === 'released_archive' ? 'background:rgba(255,255,255,0.25); color:#fff;' : 'background:#f1f5f9; color:#475569;'">
                        {{ $archivedDocCount ?? 0 }}
                    </span>
                </button>

                <span class="card-badge" style="background:#fee2e2; color:#dc2626; white-space:nowrap; flex-shrink:0; height:28px; display:inline-flex; align-items:center; padding:0 10px; font-size:9.5px; font-weight:800; border-radius:8px;">{{ $pendingDocCount ?? 0 }} Pending</span>
            </div>
        </div>

        {{-- Archive Notification Banner & Purge Controls --}}
        <div x-show="docStatusFilter === 'released_archive'" style="padding: 10px 16px; background: #eff6ff; border-bottom: 1.5px solid #bfdbfe; font-size: 11px; color: #1e40af; font-weight: 600; display: flex; align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
            <div style="display:flex; align-items:center; gap:8px;">
                <i class="fas fa-archive" style="font-size: 14px; color: #0E5393;"></i>
                <span><strong>Archived Documents ({{ $archivedDocCount ?? 0 }}):</strong> Ang mga dokumentong ito ay na-release nang higit 30 araw na.</span>
            </div>
            <div style="display:flex; align-items:center; gap:8px;">
                @if(($archivedDocCount ?? 0) > 0)
                <form action="{{ route('office.document.purge-archive') }}" method="POST" style="display:inline;"
                      onsubmit="return confirm('Kumpirmahin: Nais mo bang burahin ang lahat ng released documents na higit 30 days na sa archive? Hindi na ito maibabalik.');">
                    @csrf
                    <button type="submit" class="btn-plain btn-sm" style="background:#fee2e2; color:#dc2626; border:1.5px solid #fca5a5; padding:5px 10px; font-size:9.5px; font-weight:800; border-radius:8px; cursor:pointer; display:inline-flex; align-items:center; gap:4px; white-space:nowrap;"
                            title="Permanently remove released documents older than 30 days">
                        <i class="fas fa-trash-alt"></i> Purge Archive
                    </button>
                </form>
                @endif
                <button type="button" @click="docStatusFilter = 'all'"
                        style="padding:5px 10px; font-size:9.5px; font-weight:800; background:#fff; border:1.5px solid #cbd5e1; color:#0E5393; border-radius:8px; cursor:pointer; display:inline-flex; align-items:center; gap:4px;">
                    ← Back
                </button>
            </div>
        </div>

        <style>
            .active-filter { background:#fff; color:#0E5393; font-size:9px; font-weight:800; padding:4px 12px; border-radius:6px; border:none; box-shadow:0 1px 3px rgba(0,0,0,0.1); cursor:pointer; }
            .plain-filter { background:transparent; color:#64748b; font-size:9px; font-weight:700; padding:4px 12px; border-radius:6px; border:none; cursor:pointer; }
        </style>

        <div style="overflow-x:auto;">
            <table class="res-table">
                <thead><tr>
                    <th style="text-align:left;width:180px;">Resident</th>
                    <th>Document</th>
                    <th>Purpose</th>
                    <th>Voter</th>
                    <th>Needed / Appointment</th>
                    <th>Status</th>
                    <th style="text-align:right;">Action</th>
                </tr></thead>
                <tbody>
                    @forelse($documentRequests ?? [] as $req)
                    @php
                        $isToday = $req->appointment_date === date('Y-m-d');
                        $isFuture = $req->appointment_date > date('Y-m-d');
                        $isOldReleased = $req->status === 'released' && $req->updated_at && $req->updated_at < now()->subDays(30);
                    @endphp
                    <tr id="doc-req-{{ $req->id }}" 
                        x-show="(docFilter==='all' || (docFilter==='today' && '{{ $isToday ? '1':'0' }}' === '1')) && (
                            (docStatusFilter==='all' && '{{ $isOldReleased ? '1':'0' }}' === '0') ||
                            (docStatusFilter==='released' && '{{ $req->status==='released' && !$isOldReleased ? '1':'0' }}' === '1') ||
                            (docStatusFilter==='released_archive' && '{{ $isOldReleased ? '1':'0' }}' === '1') ||
                            (docStatusFilter==='{{ $req->status }}' && docStatusFilter!=='released' && docStatusFilter!=='all' && docStatusFilter!=='released_archive')
                        )"
                        style="transition: background-color 0.5s;">
                        <td data-label="Resident">
                            @php
                                $reqUser = $req->user;
                                if ($reqUser) {
                                    $displayName = trim(($reqUser->first_name ?? '') . ' ' . ($reqUser->last_name ?? ''));
                                    if (!$displayName) $displayName = $reqUser->name ?? '';
                                    if (!$displayName) $displayName = $reqUser->email ?? 'Unknown User';
                                    $resCode = $reqUser->resident_code ?? '—';
                                    $isGuest = false;
                                } else {
                                    $displayName = trim(($req->guest_first_name ?? '') . ' ' . ($req->guest_last_name ?? ''));
                                    $resCode = '—';
                                    $isGuest = true;
                                }
                            @endphp
                            <div style="font-size:12px;font-weight:800;color:var(--text);">
                                {{ $displayName ?: 'Unknown' }}
                                @if($isGuest)<span style="font-size:7px; background:#fee2e2; color:#dc2626; padding:2px 6px; vertical-align:middle; margin-left:4px; border-radius:4px; font-weight:900; text-transform:uppercase;">GUEST</span>@endif
                            </div>
                            <div style="font-size:10px;color:var(--muted);font-weight:600;">
                                @if($isGuest)
                                    <i class="fas fa-envelope" style="font-size:9px;"></i> {{ $req->guest_email }}
                                @else
                                    {{ $resCode }}
                                @endif
                            </div>
                        </td>
                        <td data-label="Document">
                            <div style="font-size:11px;font-weight:800;color:var(--text);">{{ ucwords(str_replace('_',' ',$req->document_type)) }}</div>
                            @if($req->claimant_type === 'authorized')
                                <div style="margin-top:4px;">
                                    <span style="font-size:8px;background:#eff6ff;color:#1e40af;padding:1px 6px;border-radius:99px;font-weight:800;" title="Relationship: {{ $req->claimant_relation }}">
                                        REP: {{ $req->claimant_first_name ? ($req->claimant_first_name . ' ' . $req->claimant_last_name) : ($req->claimant_name ?: 'Authorized') }}
                                        ({{ $req->claimant_relation ?? 'Authorized' }})
                                    </span>
                                    <div style="display:flex;gap:4px;margin-top:2px;">
                                        @if($req->authorization_letter_path)
                                        <button type="button" onclick="viewPhoto('{{ asset('storage/'.$req->authorization_letter_path) }}')" class="btn-plain btn-ghost" style="padding:2px 5px;font-size:8px;border:1px solid #bfdbfe;color:#1e40af;cursor:pointer;"><i class="fas fa-file-alt"></i> Letter</button>
                                        @endif
                                        @if($req->authorized_id_path)
                                        <button type="button" onclick="viewPhoto('{{ asset('storage/'.$req->authorized_id_path) }}')" class="btn-plain btn-ghost" style="padding:2px 5px;font-size:8px;border:1px solid #bfdbfe;color:#1e40af;cursor:pointer;"><i class="fas fa-id-card"></i> ID</button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td data-label="Purpose"><div style="font-size:11px;color:var(--muted);font-weight:600;max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $req->purpose ?? '' }}">{{ $req->purpose ?? '—' }}</div></td>
                        <td data-label="Voter">
                            @if($reqUser && $reqUser->is_voter)
                                <span style="font-size:9px;background:#dcfce7;color:#15803d;font-weight:900;padding:3px 8px;border-radius:99px;"><i class="fas fa-check-circle"></i> Voter</span>
                            @else
                                <span style="font-size:9px;background:#fef3c7;color:#a16207;font-weight:900;padding:3px 8px;border-radius:99px;"><i class="fas fa-coins"></i> Non-Voter</span>
                            @endif
                        </td>
                        <td data-label="Needed / Appointment">
                            @if($req->appointment_date)
                                <div style="font-size:10px;color:var(--brand);font-weight:800;white-space:nowrap;">
                                    <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($req->appointment_date)->format('M d, Y') }}
                                </div>
                                <div style="font-size:9px;color:var(--muted);font-weight:700;">
                                    <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($req->appointment_time)->format('h:i A') }}
                                </div>
                                @if($req->reschedule_count > 0)
                                    <span style="font-size:7.5px;background:#fef3c7;color:#b45309;padding:1px 5px;border-radius:4px;font-weight:800;display:inline-block;margin-top:2px;" title="Rescheduled {{ $req->reschedule_count }} time(s)">
                                        <i class="fas fa-history"></i> Rescheduled
                                    </span>
                                @endif
                            @else
                                <div style="font-size:10px;color:var(--muted);font-weight:600;white-space:nowrap;">{{ $req->created_at->format('M d, Y') }}</div>
                                <div style="font-size:9px;color:var(--light);">{{ $req->created_at->diffForHumans() }}</div>
                            @endif
                        </td>
                        <td data-label="Status">
                            @if($req->status === 'pending')
                                <form action="{{ route('office.document.status', $req->id) }}" method="POST" style="display:inline;margin:0;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="processing">
                                    <button type="submit" 
                                            title="Click to advance status: Pending ➡️ Processing"
                                            style="font-size:9.5px;font-weight:900;background:#fef3c7;color:#b45309;border:1.5px solid #fde68a;padding:4px 10px;border-radius:99px;cursor:pointer;display:inline-flex;align-items:center;gap:5px;transition:all .18s;box-shadow:0 1px 3px rgba(180,83,9,0.12);white-space:nowrap;">
                                        <i class="fas fa-hourglass-half"></i> <span>Pending</span> <i class="fas fa-arrow-right" style="font-size:7px;opacity:0.7;"></i>
                                    </button>
                                </form>
                            @elseif($req->status === 'processing')
                                <button type="button" 
                                        @click="showReadyModal = true; selectedReq = { id: {{ $req->id }}, type: '{{ ucwords(str_replace('_',' ',$req->document_type)) }}', name: '{{ addslashes($displayName) }}', date: '{{ $req->appointment_date ?? date('Y-m-d') }}', time: '{{ $req->appointment_time ? \Carbon\Carbon::parse($req->appointment_time)->format('H:i') : '08:00' }}' }"
                                        title="Click to set pickup schedule: Processing ➡️ Ready for Pickup"
                                        style="font-size:9.5px;font-weight:900;background:#eff6ff;color:#1d4ed8;border:1.5px solid #bfdbfe;padding:4px 10px;border-radius:99px;cursor:pointer;display:inline-flex;align-items:center;gap:5px;transition:all .18s;box-shadow:0 1px 3px rgba(29,78,216,0.12);white-space:nowrap;">
                                    <i class="fas fa-sync-alt fa-spin" style="animation-duration: 3s; font-size:8px;"></i> <span>Processing</span> <i class="fas fa-arrow-right" style="font-size:7px;opacity:0.7;"></i>
                                </button>
                            @elseif($req->status === 'ready')
                                <form action="{{ route('office.document.status', $req->id) }}" method="POST" style="display:inline;margin:0;"
                                      onsubmit="return confirm('Kumpirmahin: I-release na po ba ang dokumentong ito kay {{ addslashes($displayName) }}?{{ in_array(strtolower(str_replace(['-','_',' '],'',$req->document_type)), ['movein']) ? ' (Awtomatikong maidaragdag ang residente sa Masterlist).' : (in_array(strtolower(str_replace(['-','_',' '],'',$req->document_type)), ['moveout']) ? ' (Awtomatikong ililipat ang residente sa Archived Residents).' : '') }} Ang aksyong ito ay pinal.');">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="released">
                                    <button type="submit" 
                                            title="Click to release document to resident: Ready ➡️ Released"
                                            style="font-size:9.5px;font-weight:900;background:#ecfdf5;color:#059669;border:1.5px solid #a7f3d0;padding:4px 10px;border-radius:99px;cursor:pointer;display:inline-flex;align-items:center;gap:5px;transition:all .18s;box-shadow:0 1px 3px rgba(5,150,105,0.12);white-space:nowrap;">
                                        <i class="fas fa-calendar-check"></i> <span>Ready</span> <i class="fas fa-arrow-right" style="font-size:7px;opacity:0.7;"></i>
                                    </button>
                                </form>
                            @elseif($req->status === 'released')
                                <span style="font-size:9.5px;font-weight:900;background:#dcfce7;color:#15803d;border:1.5px solid #86efac;padding:4px 10px;border-radius:99px;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;">
                                    <i class="fas fa-box-open"></i> Released
                                </span>
                                @if($isOldReleased)
                                    <div style="font-size:8px; font-weight:800; color:#64748b; margin-top:3px; text-align:center;">
                                        <i class="fas fa-archive"></i> Archived
                                    </div>
                                @endif
                            @elseif($req->status === 'disapproved')
                                <span style="font-size:9.5px;font-weight:900;background:#fee2e2;color:#dc2626;border:1.5px solid #fca5a5;padding:4px 10px;border-radius:99px;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;" title="{{ $req->disapproval_reason ?? 'Request Disapproved' }}">
                                    <i class="fas fa-times-circle"></i> Disapproved
                                </span>
                            @else
                                <span style="font-size:9.5px;font-weight:900;background:#f1f5f9;color:#64748b;padding:4px 10px;border-radius:99px;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;">
                                    {{ ucfirst($req->status) }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;flex-wrap:wrap;">
                                @php 
                                    $reqUser = $req->user;
                                    $displayName = trim(($reqUser?->first_name ?? $reqUser?->name ?? $req->guest_first_name ?? '').' '.($reqUser?->last_name ?? $req->guest_last_name ?? ''));
                                    $resCode = $reqUser?->resident_code ?? '—';
                                    $resAddress = $req->address ?: ($reqUser?->address ?? '');
                                    $bdRaw = $req->birthday ?: ($reqUser?->birthday ? \Carbon\Carbon::parse($reqUser->birthday)->format('Y-m-d') : ''); 
                                    $resBirthplace = $reqUser?->birthplace ?? '';
                                    $storedAge = $req->age ?: ($reqUser?->age ?? '');
                                    if (!$storedAge && $bdRaw) {
                                        try {
                                            $storedAge = \Carbon\Carbon::parse($bdRaw)->age;
                                        } catch (\Exception $e) {}
                                    }
                                @endphp
                                <button
                                    title="Open & Print Document"
                                    @click="
                                        openDoc='{{ $req->document_type }}';
                                        clearDocOwner();
                                        docOwnerSearch='{{ addslashes($displayName) }} — {{ addslashes($resCode) }}';
                                        docOwnerSelectedId={{ $req->user_id ?? 'null' }};
                                        docOwnerName='{{ addslashes($displayName) }}';
                                        docOwnerAddress='{{ addslashes($resAddress) }}';
                                        docPurpose='{{ addslashes($req->purpose ?? '') }}';
                                        docOwnerBdayRaw='{{ $bdRaw }}';
                                        docOwnerAge='{{ $storedAge }}';
                                        docAge='{{ $storedAge }}';
                                        docOwnerBirthplace='{{ addslashes($resBirthplace) }}';
                                        docOwnerIsVoter={{ $reqUser?->is_voter ? 'true' : 'false' }};
                                        docDate='{{ date('Y-m-d') }}';
                                        docIssuedBy=localStorage.getItem('brgy_office_issued_by') || '{{ addslashes(Auth::user()?->first_name ?? '') }} {{ addslashes(Auth::user()?->last_name ?? '') }}'.trim() || 'Office Staff';
                                        docPosition=localStorage.getItem('brgy_office_position') || 'Barangay Staff';
                                        docBlk='{{ addslashes($req->blk ?? '') }}';
                                        docLot='{{ addslashes($req->lot ?? '') }}';
                                        docMoveDate='{{ addslashes($req->move_date ?? '') }}';
                                        docLandlordName='{{ addslashes($req->landlord ?? '') }}';
                                        docFamilyMembers='{{ addslashes($req->family_members ?? '') }}';
                                        docWardName='{{ addslashes($req->ward_name ?? '') }}';
                                        docWardAge='{{ addslashes($req->ward_age ?? '') }}';
                                        docWardRelation='{{ addslashes($req->ward_relation ?? '') }}';
                                        docPartnerName='{{ addslashes($req->partner_name ?? '') }}';
                                        docLivingSince='{{ addslashes($req->living_since ?? '') }}';
                                        docClaimantName='{{ addslashes($req->claimant_name ?? '') }}';
                                        docClaimantRelation='{{ addslashes($req->claimant_relation ?? '') }}';
                                        docSpouseName='{{ addslashes($req->claimant_name ?? '') }}';
                                        docBirthMonth='{{ addslashes($req->birth_month ?? '') }}';
                                        docBirthYear='{{ addslashes($req->birth_year ?? '') }}';
                                        docChildName='{{ addslashes($req->child_name ?? '') }}';
                                        docFatherName='{{ addslashes($req->father_name ?? '') }}';
                                        docMotherName='{{ addslashes($req->mother_name ?? '') }}';
                                        docBirthAttendant='{{ addslashes($req->birth_attendant ?? '') }}';
                                        docBornFrom='{{ addslashes($req->born_from ?? '') }}';
                                        docResidenceSince='{{ addslashes($req->residing_since ?? '') }}';
                                    "
                                    class="tbl-btn tbl-view" style="width:auto;padding:0 10px;font-size:10px;gap:4px;">
                                    <i class="fas fa-print"></i> Print
                                </button>
                                
                                @if(!in_array($req->status, ['released', 'disapproved']))
                                    <div x-data="{ showDisapprove: false, reasonSelect: '', reasonCustom: '' }" style="display:inline;">
                                        <button @click="showDisapprove = !showDisapprove" type="button" class="tbl-btn" style="background:#fee2e2;color:var(--danger);width:auto;padding:0 8px;font-size:9px;gap:3px;" title="Disapprove Request">
                                            <i class="fas fa-times"></i> Disapprove
                                        </button>
                                        <div x-show="showDisapprove" x-cloak class="modal-ov" style="z-index:200;">
                                            <div class="modal-box" style="max-width:360px;" @click.away="showDisapprove=false">
                                                <div class="modal-in">
                                                    <div class="modal-hd" style="border-bottom:none;margin-bottom:10px;padding-bottom:0;">
                                                        <div class="modal-ttl">Disapprove Request</div>
                                                        <button @click="showDisapprove=false" class="modal-close"><i class="fas fa-times"></i></button>
                                                    </div>
                                                <form action="{{ route('office.document.status', $req->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="disapproved">
                                                    <input type="hidden" name="disapproval_reason" :value="reasonSelect === 'Others' ? reasonCustom : reasonSelect">
                                                    <div class="fgrp">
                                                        <label class="flbl">Reason for Disapproval *</label>
                                                        <select x-model="reasonSelect" required class="finput fselect" style="margin-bottom:8px;">
                                                            <option value="">— Select Reason —</option>
                                                            <option value="Incomplete or Missing Requirements">Incomplete or Missing Requirements</option>
                                                            <option value="Unclear / Expired Valid ID Uploaded">Unclear / Expired Valid ID Uploaded</option>
                                                            <option value="Missing Authorization Letter or Representative ID">Missing Authorization Letter or Representative ID</option>
                                                            <option value="Information / Record Mismatch">Information / Record Mismatch</option>
                                                            <option value="Not a Registered Resident of Barangay San Miguel II">Not a Registered Resident of Barangay San Miguel II</option>
                                                            <option value="Duplicate Request Pending">Duplicate Request Pending</option>
                                                            <option value="Others">Others (Please specify)</option>
                                                        </select>
                                                        <div x-show="reasonSelect === 'Others'" x-transition>
                                                            <textarea x-model="reasonCustom" :required="reasonSelect === 'Others'" class="finput" rows="2" placeholder="Specify reason for disapproval..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div style="display:flex;justify-content:flex-end;gap:8px;">
                                                        <button type="button" @click="showDisapprove=false" class="btn-plain btn-edit">Cancel</button>
                                                        <button type="submit" class="btn-grad btn-grad-red" style="background:var(--danger);">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6"><div class="empty-st"><i class="fas fa-file-alt"></i><p>No document requests yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
