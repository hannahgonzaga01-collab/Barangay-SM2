{{-- ══ VERIFICATION REQUESTS TAB (Smart Masterlist Typo Resolution & Approval) ══ --}}
<div x-show="activeTab === 'verifications'" x-transition x-cloak>
    <div class="card" style="margin-bottom: 20px;">
        <div class="card-head" style="background: linear-gradient(135deg, #0E5393 0%, #04192D 100%); padding: 16px 20px;">
            <div class="card-title" style="color: #fff; font-size: 11px; letter-spacing: .08em; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-user-check" style="color: #38bdf8;"></i> 
                <span>SMART MASTERLIST VERIFICATION & TYPO RESOLUTION QUEUE</span>
            </div>
            <div style="display:flex; align-items:center; gap:8px;">
                <span class="card-badge" style="background: rgba(56, 189, 248, 0.2); color: #fff; border: 1px solid rgba(56, 189, 248, 0.4);">
                    {{ $pendingVerificationsCount ?? 0 }} Pending Review
                </span>
            </div>
        </div>

        <div style="padding: 16px 20px 10px; background: #eff6ff; border-bottom: 1px solid #bfdbfe; display: flex; align-items: flex-start; gap: 10px;">
            <i class="fas fa-robot" style="color: #0E5393; font-size: 16px; margin-top: 2px;"></i>
            <div style="font-size: 11px; color: #1e3a8a; line-height: 1.5; font-weight: 600;">
                <strong>AI-Assisted Fuzzy Match:</strong> Registrations are matched against the Barangay Masterlist. 
                Scores above <strong>85%</strong> indicate strong candidate matches with possible minor typos in spelling or birthdate. 
                Clicking <strong>[APPROVE & UPDATE MASTERLIST]</strong> will link or update the masterlist record with verified data and activate the resident's account.
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
                                $badgeColor = $confScore >= 85 ? 'background:#dcfce7;color:#15803d;border:1px solid #86efac;' : ($confScore >= 65 ? 'background:#fef3c7;color:#b45309;border:1px solid #fde68a;' : 'background:#fee2e2;color:#b91c1c;border:1px solid #fca5a5;');
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
                                            {{ $confLevel }} Confidence
                                        </span>
                                    </div>
                                </td>

                                <td style="padding: 14px 14px; text-align: center; vertical-align: middle;">
                                    @if($pv->voter_id_photo)
                                        <div x-data="{ openImg: false }">
                                            <button type="button" @click="openImg = true" 
                                                    style="display: inline-flex; align-items: center; gap: 5px; padding: 5px 10px; background: #eff6ff; border: 1.5px solid #bfdbfe; color: #0E5393; border-radius: 8px; font-size: 10px; font-weight: 800; cursor: pointer; transition: all .15s;">
                                                <i class="fas fa-image"></i> View ID
                                            </button>

                                            {{-- ID Photo Modal Preview --}}
                                            <div x-show="openImg" x-cloak class="modal-ov" style="z-index: 99999;" @click.self="openImg = false">
                                                <div class="modal-box" style="max-width: 520px; background: #fff; border-radius: 16px; overflow: hidden;">
                                                    <div class="modal-hd" style="background: linear-gradient(135deg,#0E5393 0%,#000052 100%); padding: 14px 18px; color: #fff; display: flex; align-items: center; justify-content: space-between;">
                                                        <span style="font-size: 12px; font-weight: 900; text-transform: uppercase;"><i class="fas fa-id-card"></i> Uploaded ID Image</span>
                                                        <button type="button" @click="openImg = false" style="background: none; border: none; color: #fff; font-size: 16px; cursor: pointer;">&times;</button>
                                                    </div>
                                                    <div style="padding: 16px; text-align: center; background: #0f172a;">
                                                        <img src="{{ asset('storage/' . $pv->voter_id_photo) }}" alt="Registrant ID" style="max-width: 100%; max-height: 480px; border-radius: 8px; object-fit: contain; box-shadow: 0 4px 20px rgba(0,0,0,0.5);">
                                                    </div>
                                                    <div style="padding: 12px 16px; background: #f8fafc; text-align: right;">
                                                        <button type="button" @click="openImg = false" class="btn-plain btn-ghost btn-sm">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span style="font-size: 9px; font-weight: 700; color: #94a3b8; font-style: italic;">No ID uploaded</span>
                                    @endif
                                </td>

                                <td style="padding: 14px 14px; text-align: right; vertical-align: middle;">
                                    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px; flex-wrap: wrap;" x-data="{ rejectModal: false, approveModal: false }">
                                        <button type="button" @click="approveModal = true" class="btn-grad btn-grad-sm" 
                                                style="background: linear-gradient(135deg, #059669 0%, #047857 100%); padding: 6px 12px; font-size: 10px; font-weight: 800; white-space: nowrap; display: inline-flex; align-items: center; gap: 5px;"
                                                title="Approve registration and link to Barangay Masterlist">
                                            <i class="fas fa-user-check"></i> Approve &amp; Link
                                        </button>

                                        <button type="button" @click="rejectModal = true" class="btn-plain btn-sm" 
                                                style="background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; padding: 6px 10px; font-size: 10px; font-weight: 800; white-space: nowrap; display: inline-flex; align-items: center; gap: 5px;"
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

                                                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; margin-bottom: 14px;">
                                                            <div style="font-size: 9.5px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 6px;">Target Masterlist Match</div>
                                                            @if($matched)
                                                                <div style="font-size: 13px; font-weight: 800; color: #0E5393;">
                                                                    <i class="fas fa-address-book"></i> {{ $matched->first_name }} {{ $matched->middle_name ? $matched->middle_name . ' ' : '' }}{{ $matched->last_name }}
                                                                </div>
                                                                <div style="font-size: 10px; color: #64748b; font-weight: 600; margin-top: 3px;">
                                                                    Code: <strong style="color: #0f172a;">{{ $matched->resident_code ?? 'NO-CODE' }}</strong> •
                                                                    AI Match: <span style="font-weight: 900; color: {{ $confScore >= 85 ? '#15803d' : '#b45309' }};">{{ $confScore }}%</span>
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
                                                        <button type="button" @click="approveModal = false" class="btn-plain btn-ghost btn-sm">Cancel</button>
                                                        <button type="submit" class="btn-grad btn-sm" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
                                                            <i class="fas fa-check"></i> Yes, Approve &amp; Link
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- Reject Prompt Modal --}}
                                        <div x-show="rejectModal" x-cloak class="modal-ov" style="text-align: left; z-index: 99999;" @click.self="rejectModal = false">
                                            <div class="modal-box" style="max-width: 460px; background: #fff; border-radius: 16px; overflow: hidden; border-bottom: 4px solid #dc2626;">
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
                                                        <button type="button" @click="rejectModal = false" class="btn-plain btn-ghost btn-sm">Cancel</button>
                                                        <button type="submit" class="btn-grad btn-sm" style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);">
                                                            Confirm Disapproval
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
