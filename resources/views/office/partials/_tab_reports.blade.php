{{-- ══ REPORTS TAB (EDITABLE OFFICE & REGISTRY MONTHLY REPORT, EXPORT PDF & SEND TO ADMIN) ══ --}}
<div x-show="activeTab==='reports'" x-transition>
    <div class="card">
        <div class="card-head">
            <div class="card-title"><i class="fas fa-file-invoice"></i> Office & Civil Registry Monthly Transmittal Report</div>
            <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                <button type="button" @click="templateUploadModal=true" class="btn-plain btn-edit" style="display:inline-flex;align-items:center;gap:6px;font-size:10px;">
                    <i class="fas fa-cloud-upload-alt"></i> Format / Template
                </button>
                <button type="button" @click="exportOfficeReportPdf()" class="btn-plain btn-edit" style="display:inline-flex;align-items:center;gap:6px;font-size:10px;background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;font-weight:800;">
                    <i class="fas fa-file-download"></i> Export PDF
                </button>
                <button type="button" @click="printOfficeReport()" class="btn-plain btn-edit" style="display:inline-flex;align-items:center;gap:6px;font-size:10px;">
                    <i class="fas fa-print"></i> Print
                </button>
                <form action="{{ route('department.reports.submit') }}" method="POST" style="margin:0;">
                    @csrf
                    <input type="hidden" name="department" value="Office">
                    <input type="hidden" name="report_title" value="MONTHLY BARANGAY REGISTRY & DOCUMENT ISSUANCE REPORT">
                    <input type="hidden" name="reporting_period" :value="officeRep.monthYear">
                    <input type="hidden" name="report_data" :value="JSON.stringify(officeRep)">
                    <input type="hidden" name="submitted_by" :value="officeRep.preparedBy">
                    <input type="hidden" name="submitted_role" :value="officeRep.preparedRole">
                    <input type="hidden" name="template_file_path" value="{{ $customTemplate['path'] ?? '' }}">
                    <button type="submit" class="btn-plain btn-green" style="display:inline-flex;align-items:center;gap:6px;font-size:10px;">
                        <i class="fas fa-paper-plane"></i> Send / Transfer to Admin
                    </button>
                </form>
            </div>
        </div>

        <div style="padding:20px;background:#f8fafc;border-bottom:1px solid var(--border);">
            {{-- ACTIVE CUSTOM TEMPLATE BANNER --}}
            @if(!empty($customTemplate))
                <div style="margin-bottom:16px;background:#f0fdf4;border:1.5px solid #86efac;border-radius:12px;padding:14px 18px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;box-shadow:0 2px 10px rgba(22,163,74,0.06);">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div style="width:38px;height:38px;border-radius:10px;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
                            <i class="fas fa-file-check"></i>
                        </div>
                        <div>
                            <div style="font-size:12.5px;font-weight:900;color:#166534;display:flex;align-items:center;gap:8px;">
                                <span>Active Custom Format: <strong>{{ $customTemplate['original_name'] }}</strong></span>
                                <span style="font-size:9.5px;background:#22c55e;color:#fff;font-weight:900;padding:2px 8px;border-radius:99px;text-transform:uppercase;">Active Template</span>
                            </div>
                            <div style="font-size:10px;color:#15803d;font-weight:600;margin-top:2px;">
                                Uploaded on {{ $customTemplate['uploaded_at'] }} ({{ $customTemplate['size_human'] }}) &bull; Automatically attached when submitting to Admin
                            </div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                        <a href="{{ asset('storage/' . $customTemplate['path']) }}" target="_blank" class="btn-plain btn-edit" style="background:#fff;border:1.5px solid #86efac;color:#166534;font-weight:800;font-size:10.5px;display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;text-decoration:none;">
                            <i class="fas fa-eye"></i> View / Download Template
                        </a>
                        <button type="button" @click="templateUploadModal=true" class="btn-plain btn-edit" style="border:1.5px solid #cbd5e1;background:#fff;font-weight:800;font-size:10.5px;display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;">
                            <i class="fas fa-sync-alt"></i> Upload New Template
                        </button>
                        <form action="{{ route('department.reports.delete_template') }}" method="POST" style="margin:0;" onsubmit="return confirm('Revert to the standard system template matrix for Office & Civil Registry?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="department" value="Office">
                            <button type="submit" class="btn-plain btn-danger" style="border:1.5px solid #fecaca;background:#fff;color:#dc2626;font-weight:800;font-size:10.5px;display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;">
                                <i class="fas fa-trash-alt"></i> Reset to Default
                            </button>
                        </form>
                    </div>
                </div>
            @endif
            <div id="office-printable-report" style="background:#fff;padding:24px;border-radius:12px;border:1.5px solid #cbd5e1;box-shadow:0 4px 12px rgba(0,0,0,0.04);font-family:'Times New Roman', serif;color:#000;">
                {{-- 3 LOGOS AND OFFICIAL LETTERHEAD --}}
                <div style="text-align:center; margin-bottom:14px;">
                    <div style="display:flex; align-items:center; justify-content:center; gap:28px; margin-bottom:8px;">
                        <img src="{{ asset('images/dasma.png') }}" style="width:68px; height:68px; object-fit:contain;" alt="City of Dasmariñas">
                        <img src="{{ asset('images/Bagong_Pilipinas_logo.png') }}" style="width:68px; height:68px; object-fit:contain;" alt="Bagong Pilipinas">
                        <img src="{{ asset('images/circlelogo.png') }}" style="width:68px; height:68px; object-fit:contain;" alt="Barangay SM2">
                    </div>
                    <div style="font-size:12px; text-transform:uppercase; letter-spacing:0.18em; font-weight:bold;">
                        REPUBLIC OF THE PHILIPPINES
                    </div>
                    <div style="font-size:11.5px; text-transform:uppercase; letter-spacing:0.12em; font-weight:bold;">
                        PROVINCE OF CAVITE
                    </div>
                    <div style="font-size:11.5px; text-transform:uppercase; letter-spacing:0.12em; font-weight:bold;">
                        CITY OF DASMARIÑAS
                    </div>
                    <div style="font-size:11.5px; text-transform:uppercase; letter-spacing:0.12em; font-weight:bold;">
                        BARANGAY SAN MIGUEL 2
                    </div>
                    <div style="font-size:12px; text-transform:uppercase; font-weight:bold; margin-top:3px; letter-spacing:0.06em;">
                        OFFICE OF THE BARANGAY SECRETARY & CIVIL REGISTRY
                    </div>
                    <div style="border-bottom:1.5px solid #000; width:100%; margin:8px auto 14px;"></div>

                    <div style="font-size:13px; font-weight:bold; text-transform:uppercase; letter-spacing:0.04em;">
                        Office of the Punong Barangay
                    </div>
                    <div style="font-size:12.5px; font-weight:bold; text-transform:uppercase; letter-spacing:0.04em; margin-top:2px;">
                        MONTHLY BARANGAY REGISTRY & DOCUMENT ISSUANCE REPORT
                    </div>
                    <div style="font-size:11.5px; font-weight:bold; text-transform:uppercase; margin-top:3px; display:flex; align-items:center; justify-content:center; gap:6px;">
                        FOR THE MONTH OF 
                        <input type="text" x-model="officeRep.monthYear" title="Click to edit Month & Year"
                               style="font-weight:bold; text-transform:uppercase; width:160px; text-align:center; font-family:'Times New Roman', serif; font-size:11.5px; border-bottom:1px solid #000; border-top:none; border-left:none; border-right:none; background:transparent; outline:none;">
                    </div>
                </div>

                {{-- Sub Meta Top-Left --}}
                <div style="font-size:11px; margin-bottom:10px; line-height:1.4;">
                    <div><strong>Province:</strong> <input type="text" x-model="officeRep.province" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:120px; font-weight:bold; background:transparent;"></div>
                    <div><strong>City:</strong> <input type="text" x-model="officeRep.city" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:140px; font-weight:bold; background:transparent;"></div>
                    <div><strong>Barangay:</strong> <input type="text" x-model="officeRep.barangay" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:140px; font-weight:bold; background:transparent;"></div>
                </div>

                {{-- Official Office Matrix Table --}}
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-size:10px; text-align:center; border:1.5px solid #000;">
                        <thead>
                            <tr style="background:#f8fafc;">
                                <th colspan="6" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:45%;">Resident Registry & Special Sectors</th>
                                <th colspan="6" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:40%;">Document Requests & Issuance</th>
                                <th colspan="2" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:15%;">Digital & Welfare</th>
                            </tr>
                            <tr style="background:#f1f5f9;">
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Total Residents</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">New This Month</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Seniors (60+)</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">PWDs</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Solo Parents</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Voters</th>

                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Brgy Clearance</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Indigency</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Residency</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Business Clear.</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Jobseeker</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL DOCS</th>

                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Digital IDs</th>
                                <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Registered Pets</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="height:44px; background:#fff;">
                                {{-- Demographics --}}
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.totalResidents" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; font-weight:bold; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.newResidentsMonth" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.seniorCount" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.pwdCount" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.soloParentCount" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.votersCount" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>

                                {{-- Document Issuances --}}
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.clearanceIssued" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.indigencyIssued" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.residencyIssued" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.businessClearanceIssued" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.firstTimeJobseekerIssued" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px; font-weight:bold; background:#f8fafc;" x-text="officeRep.totalDocsIssued"></td>

                                {{-- Digital & Welfare --}}
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.digitalIdIssued" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                                <td style="border:1px solid #000; padding:2px;">
                                    <input type="number" x-model.number="officeRep.registeredPets" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Signatures Footer --}}
                <div style="margin-top:40px; display:flex; justify-content:space-between; align-items:flex-start; padding:0 24px;">
                    <div style="width:240px; text-align:left;">
                        <div style="font-size:11px;">Prepared by :</div>
                        <div style="margin-top:35px; border-bottom:1.5px solid #000; padding-bottom:2px; text-align:center;">
                            <input type="text" x-model="officeRep.preparedBy" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-weight:bold; font-size:11.5px; text-transform:uppercase; outline:none;">
                        </div>
                        <div style="text-align:center; margin-top:2px;">
                            <input type="text" x-model="officeRep.preparedRole" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                        </div>
                    </div>

                    <div style="width:240px; text-align:left;">
                        <div style="font-size:11px;">Noted by:</div>
                        <div style="margin-top:35px; border-bottom:1.5px solid #000; padding-bottom:2px; text-align:center;">
                            <input type="text" x-model="officeRep.notedBy" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-weight:bold; font-size:11.5px; text-transform:uppercase; outline:none;">
                        </div>
                        <div style="text-align:center; margin-top:2px;">
                            <input type="text" x-model="officeRep.notedRole" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SUBMITTED REPORTS HISTORY TABLE --}}
        <div style="padding:16px 20px;">
            <div style="font-size:11px;font-weight:900;color:var(--text);text-transform:uppercase;margin-bottom:10px;display:flex;align-items:center;gap:6px;">
                <i class="fas fa-history" style="color:var(--brand);"></i> Submitted Office Transmittal Reports to Admin History
            </div>
            <table class="pet-table">
                <thead><tr>
                    <th>Report Title</th>
                    <th>Period</th>
                    <th>Submitted By</th>
                    <th>Date Submitted</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr></thead>
                <tbody>
                    @forelse(($officeReports ?? collect()) as $rep)
                    <tr>
                        <td><div style="font-size:11px;font-weight:900;color:var(--text);">{{ $rep->report_title }}</div></td>
                        <td><span class="pill pill-voter" style="font-size:9.5px;">{{ $rep->reporting_period }}</span></td>
                        <td><div style="font-size:11px;font-weight:700;">{{ $rep->submitted_by }} <span style="font-size:9px;color:var(--muted);">({{ $rep->submitted_role }})</span></div></td>
                        <td><div style="font-size:11px;color:var(--brand);font-weight:800;">{{ $rep->created_at->format('M d, Y h:i A') }}</div></td>
                        <td><span class="pill" style="background:#dcfce7;color:#15803d;font-size:9px;"><i class="fas fa-check-circle"></i> {{ $rep->status }}</span></td>
                        <td style="text-align:right;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('department.reports.show', $rep->id) }}" target="_blank" class="btn-plain btn-edit" style="font-size:10px;padding:5px 10px;" title="Preview / Print Landscape Report">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($rep->template_file)
                                <a href="{{ asset('storage/' . $rep->template_file) }}" target="_blank" class="btn-plain btn-edit" style="font-size:10px;padding:5px 10px;" title="View Attached Template">
                                    <i class="fas fa-paperclip"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6"><div class="empty-st"><i class="fas fa-file-invoice"></i><p>No office reports submitted to admin yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
