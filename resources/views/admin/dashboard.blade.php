@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('breadcrumb', 'Admin / Accueil')

@section('topbar-actions')
    <a href="{{ route('admin.actualites.create') }}" class="adm-btn adm-btn-primary">
        <i class="fas fa-plus"></i> Nouvelle publication
    </a>
@endsection

@section('content')

{{-- Visitor Stats Row --}}
<div class="adm-stats" style="grid-template-columns: repeat(4, 1fr);">
    <div class="adm-stat" style="position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; right:0; width:80px; height:80px; background:linear-gradient(135deg, rgba(21,101,192,0.08), transparent); border-radius:0 0 0 80px;"></div>
        <div class="adm-stat__icon" style="background:linear-gradient(135deg,#e3f2fd,#bbdefb); color:#1565C0;">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <div class="adm-stat__num" style="color:#1565C0;">{{ $visitStats['today'] }}</div>
            <div class="adm-stat__label">Visites aujourd'hui</div>
            <div style="font-size:11px; color:#1565C0; font-weight:600; margin-top:2px;">
                {{ $visitStats['today_unique'] }} unique{{ $visitStats['today_unique'] > 1 ? 's' : '' }}
            </div>
        </div>
    </div>
    <div class="adm-stat" style="position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; right:0; width:80px; height:80px; background:linear-gradient(135deg, rgba(46,125,50,0.08), transparent); border-radius:0 0 0 80px;"></div>
        <div class="adm-stat__icon" style="background:linear-gradient(135deg,#e8f5e9,#c8e6c9); color:#2E7D32;">
            <i class="fas fa-chart-line"></i>
        </div>
        <div>
            <div class="adm-stat__num" style="color:#2E7D32;">{{ $visitStats['week'] }}</div>
            <div class="adm-stat__label">Cette semaine</div>
            <div style="font-size:11px; color:#2E7D32; font-weight:600; margin-top:2px;">
                {{ $visitStats['week_unique'] }} unique{{ $visitStats['week_unique'] > 1 ? 's' : '' }}
            </div>
        </div>
    </div>
    <div class="adm-stat" style="position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; right:0; width:80px; height:80px; background:linear-gradient(135deg, rgba(249,168,37,0.08), transparent); border-radius:0 0 0 80px;"></div>
        <div class="adm-stat__icon" style="background:linear-gradient(135deg,#fff8e1,#ffecb3); color:#F9A825;">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div>
            <div class="adm-stat__num" style="color:#e59400;">{{ $visitStats['month'] }}</div>
            <div class="adm-stat__label">Ce mois</div>
            <div style="font-size:11px; color:#e59400; font-weight:600; margin-top:2px;">
                {{ $visitStats['month_unique'] }} unique{{ $visitStats['month_unique'] > 1 ? 's' : '' }}
            </div>
        </div>
    </div>
    <div class="adm-stat" style="position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; right:0; width:80px; height:80px; background:linear-gradient(135deg, rgba(141,110,99,0.08), transparent); border-radius:0 0 0 80px;"></div>
        <div class="adm-stat__icon" style="background:linear-gradient(135deg,#efebe9,#d7ccc8); color:#6D4C41;">
            <i class="fas fa-globe-africa"></i>
        </div>
        <div>
            <div class="adm-stat__num" style="color:#6D4C41;">{{ $visitStats['total'] }}</div>
            <div class="adm-stat__label">Total visites</div>
            <div style="font-size:11px; color:#6D4C41; font-weight:600; margin-top:2px;">
                {{ $visitStats['total_unique'] }} visiteur{{ $visitStats['total_unique'] > 1 ? 's' : '' }} unique{{ $visitStats['total_unique'] > 1 ? 's' : '' }}
            </div>
        </div>
    </div>
</div>

{{-- 7-day chart --}}
<div class="adm-card" style="margin-bottom:28px;">
    <div class="adm-card__header">
        <span class="adm-card__title"><i class="fas fa-chart-bar" style="color:#1565C0; margin-right:8px;"></i> Visites – 7 derniers jours</span>
    </div>
    <div class="adm-card__body" style="padding:20px;">
        <canvas id="visitChart" height="220" style="width:100%;"></canvas>
    </div>
</div>

{{-- Content Stats --}}
<div class="adm-stats">
    <div class="adm-stat">
        <div class="adm-stat__icon" style="background:#e8f5e9; color:#2E7D32;">
            <i class="fas fa-newspaper"></i>
        </div>
        <div>
            <div class="adm-stat__num">{{ $stats['total'] }}</div>
            <div class="adm-stat__label">Publications totales</div>
        </div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat__icon" style="background:#e8f5e9; color:#1B5E20;">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <div class="adm-stat__num" style="color:#2E7D32;">{{ $stats['publiees'] }}</div>
            <div class="adm-stat__label">Publications en ligne</div>
        </div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat__icon" style="background:#fef3c7; color:#d97706;">
            <i class="fas fa-trophy"></i>
        </div>
        <div>
            <div class="adm-stat__num" style="color:#d97706;">{{ $stats['total_reals'] }}</div>
            <div class="adm-stat__label">Réalisations totales</div>
        </div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat__icon" style="background:#e3f2fd; color:#1565C0;">
            <i class="fas fa-eye"></i>
        </div>
        <div>
            <div class="adm-stat__num" style="color:#1565C0;">{{ $stats['reals_actives'] }}</div>
            <div class="adm-stat__label">Réalisations visibles</div>
        </div>
    </div>
</div>

{{-- Recent publications --}}
<div class="adm-card">
    <div class="adm-card__header">
        <span class="adm-card__title"><i class="fas fa-clock" style="color:#2E7D32; margin-right:8px;"></i> Publications Récentes</span>
        <a href="{{ route('admin.actualites.index') }}" class="adm-btn adm-btn-outline adm-btn-sm">Voir tout</a>
    </div>
    <div class="adm-card__body" style="padding:0;">
        @if($stats['recentes']->isEmpty())
            <div style="padding:40px; text-align:center; color:#7a9a7d;">
                <i class="fas fa-newspaper" style="font-size:36px; margin-bottom:12px; display:block;"></i>
                Aucune publication pour l'instant.
                <br><br>
                <a href="{{ route('admin.actualites.create') }}" class="adm-btn adm-btn-primary">Créer la première</a>
            </div>
        @else
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recentes'] as $actu)
                    <tr>
                        <td>
                            <div style="font-weight:600; color:#1a2e1b;">{{ Str::limit($actu->titre, 60) }}</div>
                            <div style="font-size:12px; color:#7a9a7d; margin-top:2px;">{{ Str::limit($actu->extrait, 80) }}</div>
                        </td>
                        <td style="color:#7a9a7d; font-size:13px; white-space:nowrap;">
                            {{ $actu->date_formattee }}
                        </td>
                        <td>
                            @if($actu->publie)
                                <span class="adm-badge adm-badge-green"><i class="fas fa-circle" style="font-size:6px;"></i> En ligne</span>
                            @else
                                <span class="adm-badge adm-badge-yellow"><i class="fas fa-circle" style="font-size:6px;"></i> Brouillon</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('admin.actualites.edit', $actu) }}" class="adm-btn adm-btn-outline adm-btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- Quick actions --}}
<div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; margin-top:20px;">
    <div class="adm-card">
        <div class="adm-card__body" style="text-align:center; padding:28px;">
            <div style="font-size:32px; margin-bottom:12px;">📝</div>
            <div style="font-weight:700; color:#1a2e1b; margin-bottom:6px;">Nouvelle publication</div>
            <div style="font-size:13px; color:#7a9a7d; margin-bottom:16px;">Partagez vos actualités et conseils agronomiques.</div>
            <a href="{{ route('admin.actualites.create') }}" class="adm-btn adm-btn-primary">
                <i class="fas fa-plus"></i> Créer
            </a>
        </div>
    </div>
    <div class="adm-card">
        <div class="adm-card__body" style="text-align:center; padding:28px;">
            <div style="font-size:32px; margin-bottom:12px;">🏆</div>
            <div style="font-weight:700; color:#1a2e1b; margin-bottom:6px;">Nouvelle réalisation</div>
            <div style="font-size:13px; color:#7a9a7d; margin-bottom:16px;">Ajoutez un projet terrain à votre portfolio.</div>
            <a href="{{ route('admin.realisations.create') }}" class="adm-btn adm-btn-jaune">
                <i class="fas fa-plus"></i> Créer
            </a>
        </div>
    </div>
    <div class="adm-card">
        <div class="adm-card__body" style="text-align:center; padding:28px;">
            <div style="font-size:32px; margin-bottom:12px;">🌐</div>
            <div style="font-weight:700; color:#1a2e1b; margin-bottom:6px;">Voir le site public</div>
            <div style="font-size:13px; color:#7a9a7d; margin-bottom:16px;">Vérifiez le rendu de vos contenus en ligne.</div>
            <a href="{{ route('home') }}" target="_blank" class="adm-btn adm-btn-outline">
                <i class="fas fa-external-link-alt"></i> Ouvrir
            </a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('visitChart');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');

    const data = @json($chartData);
    const labels = data.map(d => d.label);
    const visits = data.map(d => d.visits);
    const unique = data.map(d => d.unique);
    const maxVal = Math.max(...visits, 1);

    const dpr = window.devicePixelRatio || 1;
    const rect = canvas.getBoundingClientRect();
    canvas.width = rect.width * dpr;
    canvas.height = 220 * dpr;
    ctx.scale(dpr, dpr);
    canvas.style.height = '220px';

    const W = rect.width, H = 220;
    const padL = 45, padR = 20, padT = 20, padB = 40;
    const chartW = W - padL - padR;
    const chartH = H - padT - padB;
    const barW = chartW / labels.length;

    // Grid lines
    ctx.strokeStyle = '#e8ede9';
    ctx.lineWidth = 1;
    for (let i = 0; i <= 4; i++) {
        const y = padT + (chartH / 4) * i;
        ctx.beginPath(); ctx.moveTo(padL, y); ctx.lineTo(W - padR, y); ctx.stroke();
        ctx.fillStyle = '#7a9a7d'; ctx.font = '11px Inter'; ctx.textAlign = 'right';
        ctx.fillText(Math.round(maxVal - (maxVal / 4) * i), padL - 8, y + 4);
    }

    // Bars
    labels.forEach((label, i) => {
        const x = padL + barW * i + barW * 0.15;
        const bw = barW * 0.3;

        // Total visits bar
        const h1 = (visits[i] / maxVal) * chartH;
        const grad1 = ctx.createLinearGradient(0, padT + chartH - h1, 0, padT + chartH);
        grad1.addColorStop(0, '#1565C0'); grad1.addColorStop(1, '#42A5F5');
        ctx.fillStyle = grad1;
        roundRect(ctx, x, padT + chartH - h1, bw, h1, 4);

        // Unique visits bar
        const h2 = (unique[i] / maxVal) * chartH;
        const grad2 = ctx.createLinearGradient(0, padT + chartH - h2, 0, padT + chartH);
        grad2.addColorStop(0, '#2E7D32'); grad2.addColorStop(1, '#66BB6A');
        ctx.fillStyle = grad2;
        roundRect(ctx, x + bw + 4, padT + chartH - h2, bw, h2, 4);

        // Value labels
        if (visits[i] > 0) {
            ctx.fillStyle = '#1565C0'; ctx.font = 'bold 10px Inter'; ctx.textAlign = 'center';
            ctx.fillText(visits[i], x + bw / 2, padT + chartH - h1 - 5);
        }
        if (unique[i] > 0) {
            ctx.fillStyle = '#2E7D32'; ctx.font = 'bold 10px Inter';
            ctx.fillText(unique[i], x + bw + 4 + bw / 2, padT + chartH - h2 - 5);
        }

        // X labels
        ctx.fillStyle = '#7a9a7d'; ctx.font = '11px Inter'; ctx.textAlign = 'center';
        ctx.fillText(label, padL + barW * i + barW / 2, H - 10);
    });

    // Legend
    ctx.fillStyle = '#1565C0'; roundRect(ctx, W - 180, 6, 10, 10, 2);
    ctx.fillStyle = '#1a2e1b'; ctx.font = '11px Inter'; ctx.textAlign = 'left';
    ctx.fillText('Visites', W - 165, 15);
    ctx.fillStyle = '#2E7D32'; roundRect(ctx, W - 100, 6, 10, 10, 2);
    ctx.fillStyle = '#1a2e1b'; ctx.fillText('Uniques', W - 85, 15);

    function roundRect(ctx, x, y, w, h, r) {
        if (h <= 0) return;
        r = Math.min(r, h / 2, w / 2);
        ctx.beginPath();
        ctx.moveTo(x + r, y);
        ctx.lineTo(x + w - r, y);
        ctx.quadraticCurveTo(x + w, y, x + w, y + r);
        ctx.lineTo(x + w, y + h);
        ctx.lineTo(x, y + h);
        ctx.lineTo(x, y + r);
        ctx.quadraticCurveTo(x, y, x + r, y);
        ctx.closePath();
        ctx.fill();
    }
});
</script>
@endpush

@push('styles')
<style>
    @media (max-width: 768px) {
        .adm-stats[style*="grid-template-columns: repeat(4"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
        div[style*="grid-template-columns:2fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
        div[style*="grid-template-columns:1fr 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush
