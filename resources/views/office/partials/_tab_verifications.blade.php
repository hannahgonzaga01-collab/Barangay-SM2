{{-- ══ VERIFICATION REQUESTS TAB (Smart Masterlist Typo Resolution & Approval) ══ --}}
<div x-show="activeTab === 'verifications'" x-transition x-cloak>
    <div class="card" style="margin-bottom: 20px;">
        <div class="card-head" style="background: linear-gradient(135deg, #0E5393 0%, #04192D 100%); padding: 16px 20px;">
            <div class="card-title" style="color: #fff; font-size: 11px; letter-spacing: .08em; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-user-check" style="color: #38bdf8;"></i> 
                <span>MASTERLIST VERIFICATION & RESIDENT MATCHING QUEUE</span>
            </div>
            <div style="display:flex; align-items:center; gap:8px;">
                <span class="card-badge" style="background: rgba(56, 189, 248, 0.2); color: #fff; border: 1px solid rgba(56, 189, 248, 0.4);">
                    {{ $pendingVerificationsCount ?? 0 }} Pending Review
                </span>
            </div>
        </div>

        <div style="padding: 16px 20px 10px; background: #eff6ff; border-bottom: 1px solid #bfdbfe; display: flex; align-items: flex-start; gap: 10px;">
            <i class="fas fa-search-plus" style="color: #0E5393; font-size: 16px; margin-top: 2px;"></i>
            <div style="font-size: 11px; color: #1e3a8a; line-height: 1.5; font-weight: 600;">
                <strong>Masterlist Cross-Matching:</strong> Sinusuri ng system ang impormasyon ng nagparehistro laban sa Barangay Masterlist. 
                Ang mga record na may <strong>85% pataas</strong> ay may mataas na pagkakatugma na maaaring may kaunting typo sa baybay (spelling) o birthday. 
                I-click ang <strong>[Approve]</strong> upang i-activate ang account ng residente at i-link o i-update sa masterlist.
            </div>
        </div>

        @if(($pendingVerifications ?? collect())->isEmpty())
            <div class="empty-st" style="padding: 48px 20px;">
                <i class="fas fa-check-double" style="color: #10b981; font-size: 36px; opacity: 0.8; margin-bottom: 10px;"></i>
                <p style="font-size: 13px; font-weight: 800; color: #334155;">All Caught Up!</p>
                <p style="font-size: 11px; color: #64748b; font-weight: 600; margin-top: 4px;">No pending resident account verification requests.</p>
            </div>
        @else
            <div style="overflow-x: auto;">
                <table class="res-table" style="width: 100%; border-collapse: collapse; min-width: 820px;">
                    <thead>
                        <tr>
                            <th style="padding: 12px 14px; width: 27%;">Registrant Input</th>
                            <th style="padding: 12px 14px; width: 28%;">Matched Masterlist Record</th>
                            <th style="padding: 12px 14px; width: 14%; text-align: center;">Match Accuracy</th>
                            <th style="padding: 12px 14px; width: 13%; text-align: center;">ID / Proof</th>
                            <th style="padding: 12px 14px; width: 18%; text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingVerifications as $pv)
                            @php
                                $confScore = $pv->confidence_score ?? 0;
                                $confLevel = $pv->confidence_level ?? 'Low';
                                $badgeColor = $confScore >= 85 
                                    ? 'background:#dcfce7;color:#15803d;border:1px solid #86efac;' 
                                    : ($confScore >= 65 
                                        ? 'background:#fef3c7;color:#b45309;border:1px solid #fde68a;' 
                                        : ($confScore >= 50 
                                            ? 'background:#fee2e2;color:#b91c1c;border:1px solid #fca5a5;' 
                                            : 'background:#f1f5f9;color:#64748b;border:1px solid #cbd5e1;'));
                                $matched = $pv->matched_resident;
                            @endphp
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 14px 14px; vertical-align: middle;">
                                    <div style="font-size: 13px; font-weight: 800; color: #0f172a;">
                                        {{ $pv->first_name }} {{ $pv->middle_name ? $pv->middle_name . ' ' : '' }}{{ $pv->last_name }}
                                    </div>
                                    <div style="font-size: 10px; color: #64748b; font-weight: 600; margin-top: 3px; display: flex; align-items: center; gap: 8px;">
                                        <span><i class="fas fa-birthday-cake" style="color:#0E5393;"></i> {{ $pv->birthday ? $pv->birthday->format('M d, Y') : 'N/A' }}</span>
                                        <span>•</span>
                                        <span><i class="fas fa-envelope" style="color:#0E5393;"></i> {{ $pv->email }}</span>
                                    </div>
                                    @if($pv->is_voter)
                                        <div style="margin-top: 4px;">
                                            <span style="font-size: 8.5px; font-weight: 900; background: #eff6ff; color: #1d4ed8; padding: 2px 7px; border-radius: 99px;">
                                                <i class="fas fa-vote-yea"></i> Voter (Precinct: {{ $pv->precinct_no ?? 'N/A' }})
                                            </span>
                                        </div>
                                    @else
                                        <div style="margin-top: 4px;">
                                            <span style="font-size: 8.5px; font-weight: 800; background: #f1f5f9; color: #64748b; padding: 2px 7px; border-radius: 99px;">
                                                Non-Voter Registrant
                                            </span>
                                        </div>
                                    @endif

                                    @if(!empty($pv->move_in_request))
                                        @php
                                            $mReq = $pv->move_in_request;
                                            $mReqYear = $mReq->created_at ? $mReq->created_at->format('Y') : date('Y');
                                            $mReqSeq = str_pad($mReq->id, 5, '0', STR_PAD_LEFT);
                                            $mReqCode = "REQ-{$mReqYear}-{$mReqSeq}";
                                            $mReqStatus = strtolower($mReq->status ?? 'pending');
                                            $mStatusBg = match($mReqStatus) {
                                                'ready' => '#dcfce7',
                                                'released' => '#f1f5f9',
                                                'processing' => '#dbeafe',
                                                'disapproved' => '#fee2e2',
                                                default => '#fef3c7',
                                            };
                                            $mStatusColor = match($mReqStatus) {
                                                'ready' => '#15803d',
                                                'released' => '#475569',
                                                'processing' => '#1d4ed8',
                                                'disapproved' => '#dc2626',
                                                default => '#a16207',
                                            };
                                        @endphp
                                        <div style="margin-top: 8px; background: #f0f9ff; border: 1.5px solid #7dd3fc; border-radius: 10px; padding: 9px 11px; box-shadow: 0 1px 3px rgba(3,105,161,0.08);">
                                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 6px; flex-wrap: wrap;">
                                                <div style="font-size: 10px; font-weight: 900; color: #0369a1; display: inline-flex; align-items: center; gap: 5px;">
                                                    <i class="fas fa-truck-moving"></i> <span>May Move-In Application</span>
                                                </div>
                                                <span style="font-size: 8px; font-weight: 900; padding: 2px 7px; border-radius: 99px; background: {{ $mStatusBg }}; color: {{ $mStatusColor }}; text-transform: uppercase; border: 1px solid rgba(0,0,0,0.05);">
                                                    {{ ucfirst($mReqStatus) }}
                                                </span>
                                            </div>

                                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 6px; margin-top: 6px; flex-wrap: wrap;">
                                                <button type="button" 
                                                        @click="activeTab = 'requests'; docFilter = 'all'; docStatusFilter = 'all'; docSearchQuery = '{{ $mReqCode }}'; localStorage.setItem('brgy_office_tab', 'requests'); window.scrollTo({ top: 0, behavior: 'smooth' });"
                                                        title="I-click para hanapin at tingnan sa Document Requests tab"
                                                        style="display: inline-flex; align-items: center; gap: 5px; background: #0284c7; color: #fff; font-size: 9.5px; font-weight: 800; padding: 3px 9px; border-radius: 6px; border: none; cursor: pointer; transition: all .15s; box-shadow: 0 1px 3px rgba(2,132,199,0.3);"
                                                        onmouseover="this.style.background='#0369a1'; this.style.transform='translateY(-1px)';"
                                                        onmouseout="this.style.background='#0284c7'; this.style.transform='none';">
                                                    <i class="fas fa-receipt"></i> <span>{{ $mReqCode }}</span>
                                                    <i class="fas fa-arrow-right" style="font-size: 7.5px; opacity: 0.85;"></i>
                                                </button>

                                                @if($mReq->move_date)
                                                    <span style="font-size: 8.5px; color: #0369a1; font-weight: 700; display: inline-flex; align-items: center; gap: 3px;">
                                                        <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($mReq->move_date)->format('M d, Y') }}
                                                    </span>
                                                @endif
                                            </div>

                                            <div style="font-size: 9px; color: #0284c7; margin-top: 5px; line-height: 1.35; font-weight: 600;">
                                                <span>Lilipatan: <strong>{{ ($mReq->blk ? 'Blk ' . $mReq->blk . ' ' : '') . ($mReq->lot ? 'Lot ' . $mReq->lot : '') ?: 'San Miguel II' }}</strong></span>
                                                @if($mReq->landlord)
                                                    <span> • Landlord/Owner: <strong>{{ $mReq->landlord }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </td>

                                <td style="padding: 14px 14px; vertical-align: middle;">
                                    @if($matched)
                                        <div style="font-size: 12.5px; font-weight: 800; color: #0E5393;">
                                            <i class="fas fa-address-book"></i> {{ $matched->first_name }} {{ $matched->middle_name ? $matched->middle_name . ' ' : '' }}{{ $matched->last_name }}
                                        </div>
                                        <div style="font-size: 10px; color: #64748b; font-weight: 600; margin-top: 2px;">
                                            Code: <strong style="color:#0f172a;">{{ $matched->resident_code ?? 'NO-CODE' }}</strong> •
                                            Bday: <strong>{{ $matched->birthday ? \Carbon\Carbon::parse($matched->birthday)->format('M d, Y') : 'N/A' }}</strong>
                                        </div>
                                        @if($matched->address)
                                            <div style="font-size: 9.5px; color: #475569; margin-top: 2px;">
                                                <i class="fas fa-map-marker-alt" style="color:#0E5393;"></i> {{ $matched->address }}
                                            </div>
                                        @endif
                                    @else
                                        <div style="font-size: 11px; font-weight: 700; color: #94a3b8; font-style: italic;">
                                            No close Masterlist candidate found (< 50%).
                                        </div>
                                    @endif
                                </td>

                                <td style="padding: 14px 14px; text-align: center; vertical-align: middle;">
                                    <div style="display: inline-flex; flex-direction: column; align-items: center; gap: 3px;">
                                        <span style="font-size: 12px; font-weight: 900; padding: 3px 10px; border-radius: 99px; {{ $badgeColor }}">
                                            {{ $confScore }}% Match
                                        </span>
                                        <span style="font-size: 8.5px; font-weight: 800; text-transform: uppercase; color: #64748b;">
                                            {{ $confScore >= 50 ? ($confLevel . ' Confidence') : 'No Match' }}
                                        </span>
                                    </div>
                                </td>

                                <td style="padding: 14px 14px; text-align: center; vertical-align: middle;">
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                                        @if($pv->voter_id_photo)
                                            <div>
                                                @if(!empty($pv->id_type))
                                                    <div style="margin-bottom: 3px;">
                                                        <span style="font-size: 8px; font-weight: 800; color: #0369a1; background: #e0f2fe; border: 1px solid #bae6fd; padding: 2px 6px; border-radius: 99px; display: inline-block;">
                                                            {{ $pv->id_type }}
                                                        </span>
                                                    </div>
                                                @endif
                                                @php
                                                    $vip = $pv->voter_id_photo;
                                                    $vipUrl = str_starts_with($vip, 'http') ? $vip : (str_starts_with($vip, 'storage/') ? asset($vip) : asset('storage/' . ltrim($vip, '/')));
                                                @endphp
                                                <button type="button" onclick="viewPhoto('{{ $vipUrl }}', 'Voter Registration ID')" 
                                                        style="display: inline-flex; align-items: center; gap: 5px; padding: 5px 10px; background: #eff6ff; border: 1.5px solid #bfdbfe; color: #0E5393; border-radius: 8px; font-size: 10px; font-weight: 800; cursor: pointer; transition: all .15s;"
                                                        onmouseover="this.style.background='#dbeafe'"
                                                        onmouseout="this.style.background='#eff6ff'">
                                                    <i class="fas fa-image"></i> View ID
                                                </button>
                                            </div>
                                        @endif

                                        @if(!empty($pv->move_in_request?->id_proof))
                                            @php
                                                $mip = $pv->move_in_request->id_proof;
                                                $mipUrl = str_starts_with($mip, 'http') ? $mip : (str_starts_with($mip, 'storage/') ? asset($mip) : asset('storage/' . ltrim($mip, '/')));
                                            @endphp
                                            <div>
                                                <button type="button" onclick="viewPhoto('{{ $mipUrl }}', 'Move-In ID / Proof')" 
                                                        style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 9px; background: #f0fdf4; border: 1.5px solid #86efac; color: #166534; border-radius: 8px; font-size: 9.5px; font-weight: 800; cursor: pointer; transition: all .15s;"
                                                        onmouseover="this.style.background='#dcfce7'"
                                                        onmouseout="this.style.background='#f0fdf4'">
                                                    <i class="fas fa-file-invoice"></i> Move-In Proof
                                                </button>
                                            </div>
                                        @endif

                                        @if(!$pv->voter_id_photo && empty($pv->move_in_request?->id_proof))
                                            <span style="font-size: 9px; font-weight: 700; color: #94a3b8; font-style: italic;">No ID uploaded</span>
                                        @endif
                                    </div>
                                </td>

                                <td style="padding: 14px 14px; text-align: right; vertical-align: middle;">
                                    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px; flex-wrap: wrap;" 
                                         x-data="{ rejectModal: false, approveModal: false }"
                                         @keydown.window.escape="approveModal = false; rejectModal = false;">
                                        <button type="button" @click="approveModal = true" class="btn-grad btn-grad-sm" 
                                                style="background: linear-gradient(135deg, #059669 0%, #047857 100%); padding: 6px 14px; font-size: 10px; font-weight: 800; white-space: nowrap; display: inline-flex; align-items: center; gap: 5px; cursor: pointer;"
                                                title="Approve registration">
                                            <i class="fas fa-check"></i> Approve
                                        </button>

                                        <button type="button" @click="rejectModal = true" class="btn-plain btn-sm" 
                                                style="background: #fee2e2; color: #dc2626; border: 1.5px solid #fca5a5; padding: 6px 10px; font-size: 10px; font-weight: 800; white-space: nowrap; display: inline-flex; align-items: center; gap: 5px; cursor: pointer;"
                                                title="Disapprove registration request">
                                            <i class="fas fa-times"></i> Disapprove
                                        </button>

                                        {{-- Custom Styled Approve Modal --}}
                                        <div x-show="approveModal" x-cloak class="modal-ov" style="text-align: left; z-index: 99999;" @click.self="approveModal = false">
                                            <div class="modal-box" style="max-width: 480px; background: #fff; border-radius: 16px; overflow: hidden; border-top: 4px solid #059669; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);">
                                                <div class="modal-hd" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); padding: 14px 18px; color: #fff; display: flex; align-items: center; justify-content: space-between;">
                                                    <span style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: .05em; display: flex; align-items: center; gap: 8px;">
                                                        <i class="fas fa-user-check"></i> Confirm Masterlist Approval
                                                    </span>
                                                    <button type="button" @click="approveModal = false" style="background: none; border: none; color: #fff; font-size: 18px; cursor: pointer; line-height: 1;">&times;</button>
                                                </div>
                                                <form method="POST" action="{{ route('office.verification.approve', $pv->id) }}">
                                                    @csrf
                                                    @if($matched)
                                                        <input type="hidden" name="resident_id" value="{{ $matched->id }}">
                                                    @endif
                                                    <div style="padding: 18px;">
                                                        <p style="font-size: 12px; color: #334155; font-weight: 600; margin-bottom: 14px; line-height: 1.5;">
                                                            Approve <strong>{{ $pv->first_name }} {{ $pv->last_name }}</strong>'s registration and update the Barangay Masterlist?
                                                        </p>

                                                        @if(!empty($pv->move_in_request))
                                                            @php
                                                                $mReq = $pv->move_in_request;
                                                                $mReqYear = $mReq->created_at ? $mReq->created_at->format('Y') : date('Y');
                                                                $mReqSeq = str_pad($mReq->id, 5, '0', STR_PAD_LEFT);
                                                                $mReqCode = "REQ-{$mReqYear}-{$mReqSeq}";
                                                            @endphp
                                                            <div style="background: #e0f2fe; border: 1.5px solid #38bdf8; border-radius: 10px; padding: 10px 14px; margin-bottom: 14px;">
                                                                <div style="display: flex; align-items: center; justify-content: space-between; gap: 6px; margin-bottom: 4px;">
                                                                    <div style="font-size: 10px; font-weight: 800; color: #0369a1; text-transform: uppercase; display: flex; align-items: center; gap: 5px;">
                                                                        <i class="fas fa-truck-moving"></i> Move-In Application Detected
                                                                    </div>
                                                                    <span style="font-size: 8.5px; font-weight: 900; background: #0284c7; color: #fff; padding: 2px 7px; border-radius: 5px;">
                                                                        {{ $mReqCode }}
                                                                    </span>
                                                                </div>
                                                                <div style="font-size: 11px; color: #0c4a6e; font-weight: 700;">
                                                                    Bagong Lipat sa Barangay: {{ ($mReq->blk ? 'Blk ' . $mReq->blk . ' ' : '') . ($mReq->lot ? 'Lot ' . $mReq->lot : '') ?: 'San Miguel II' }}
                                                                </div>
                                                                <div style="font-size: 9.5px; color: #0284c7; margin-top: 3px;">
                                                                    Awtomatikong mai-activate ang account, mailalapat ang bagong tirahan sa Masterlist, at mamarkahang opisyal ang kanyang Move-In form.
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; margin-bottom: 14px;">
                                                            <div style="font-size: 9.5px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 6px;">Target Masterlist Match</div>
                                                            @if($matched)
                                                                <div style="font-size: 13px; font-weight: 800; color: #0E5393;">
                                                                    <i class="fas fa-address-book"></i> {{ $matched->first_name }} {{ $matched->middle_name ? $matched->middle_name . ' ' : '' }}{{ $matched->last_name }}
                                                                </div>
                                                                <div style="font-size: 10px; color: #64748b; font-weight: 600; margin-top: 3px;">
                                                                    Code: <strong style="color: #0f172a;">{{ $matched->resident_code ?? 'NO-CODE' }}</strong> •
                                                                    Match Score: <span style="font-weight: 900; color: {{ $confScore >= 85 ? '#15803d' : '#b45309' }};">{{ $confScore }}%</span>
                                                                </div>
                                                            @else
                                                                <div style="font-size: 11px; font-weight: 700; color: #94a3b8; font-style: italic;">
                                                                    No existing record selected — a verified entry will be created in the Masterlist.
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div style="background: #eff6ff; border-left: 3px solid #3b82f6; padding: 8px 12px; border-radius: 4px; font-size: 10.5px; color: #1e40af; font-weight: 600;">
                                                            <i class="fas fa-info-circle"></i> Once confirmed, the resident's portal account will be fully activated.
                                                        </div>
                                                    </div>
                                                    <div style="padding: 12px 18px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 8px;">
                                                        <button type="button" @click="approveModal = false" class="btn-plain btn-sm" style="background: #f1f5f9; color: #475569; border: 1.5px solid #cbd5e1; font-weight: 800; cursor: pointer;">Cancel</button>
                                                        <button type="submit" class="btn-grad btn-sm" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); cursor: pointer; font-weight: 800;">
                                                            <i class="fas fa-check"></i> Yes, Approve
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- Reject Prompt Modal --}}
                                        <div x-show="rejectModal" x-cloak class="modal-ov" style="text-align: left; z-index: 99999;" @click.self="rejectModal = false">
                                            <div class="modal-box" style="max-width: 460px; background: #fff; border-radius: 16px; overflow: hidden; border-bottom: 4px solid #dc2626; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);">
                                                <div class="modal-hd" style="padding: 14px 18px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                                                    <span style="font-size: 12px; font-weight: 900; color: #991b1b; text-transform: uppercase;">
                                                        <i class="fas fa-user-times"></i> Disapprove Registration
                                                    </span>
                                                    <button type="button" @click="rejectModal = false" style="background: none; border: none; color: #64748b; font-size: 16px; cursor: pointer;">&times;</button>
                                                </div>
                                                <form method="POST" action="{{ route('office.verification.reject', $pv->id) }}">
                                                    @csrf
                                                    <div style="padding: 18px;">
                                                        <p style="font-size: 11px; color: #475569; font-weight: 600; margin-bottom: 12px;">
                                                            Please provide a clear reason for disapproving <strong>{{ $pv->name }}</strong>'s registration.
                                                        </p>
                                                        <label class="flbl" for="rejection_reason_{{ $pv->id }}">Rejection Reason *</label>
                                                        <textarea id="rejection_reason_{{ $pv->id }}" name="rejection_reason" required class="finput" rows="3"
                                                                  placeholder="e.g. Details and submitted ID do not match our official records or reside in another barangay."></textarea>
                                                    </div>
                                                    <div style="padding: 12px 18px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 8px;">
                                                        <button type="button" @click="rejectModal = false" class="btn-plain btn-sm" style="background: #f1f5f9; color: #475569; border: 1.5px solid #cbd5e1; font-weight: 800; cursor: pointer;">Cancel</button>
                                                        <button type="submit" class="btn-grad btn-sm" style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); cursor: pointer; font-weight: 800;">
                                                            <i class="fas fa-times"></i> Confirm Disapproval
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
