@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">

        {{-- Горна лента с код --}}
        <div class="panel panel-danger">
            <div class="panel-heading" style="font-size:16px;">
                <strong>
                    @if($code == 404) 🔍
                    @elseif($code == 403) 🔒
                    @elseif($code == 401) 🔑
                    @elseif($code == 405) ⚠️
                    @else 💥
                    @endif
                    HTTP {{ $code }} — {{ $title }}
                </strong>
            </div>

            <div class="panel-body">

                {{-- Човешко обяснение --}}
                <div class="alert alert-warning" style="margin-bottom:16px;">
                    <p style="margin:0 0 8px 0; font-size:15px;">{!! $explanation !!}</p>
                    <p style="margin:0; color:#666;"><em>💡 {!! $tip !!}</em></p>
                </div>

                {{-- Технически детайли (винаги видими) --}}
                <div>
                    <p><strong>Техническа грешка:</strong></p>
                    <pre style="background:#f8f8f8; border:1px solid #ddd; padding:12px;
                                border-radius:4px; white-space:pre-wrap; word-break:break-word;
                                font-size:12px; color:#c7254e; max-height:200px; overflow-y:auto;">{{ $technical }}</pre>
                </div>

                {{-- Stack trace – само ако APP_DEBUG=true --}}
                @if($showTrace && $trace)
                <div style="margin-top:12px;">
                    <a href="#" onclick="
                        var el = document.getElementById('err-trace');
                        el.style.display = el.style.display === 'none' ? 'block' : 'none';
                        this.textContent = el.style.display === 'none' ? '▶ Покажи stack trace' : '▼ Скрий stack trace';
                        return false;
                    " style="font-size:12px; color:#888;">▶ Покажи stack trace</a>
                    <pre id="err-trace"
                         style="display:none; margin-top:8px; background:#1e1e1e; color:#d4d4d4;
                                padding:12px; border-radius:4px; font-size:11px;
                                white-space:pre-wrap; word-break:break-word;
                                max-height:400px; overflow-y:auto;">{{ $trace }}</pre>
                </div>
                @endif

                {{-- Бутони --}}
                <div style="margin-top:16px;">
                    <a href="javascript:history.back()" class="btn btn-default btn-sm">← Назад</a>
                    <a href="{{ url('/admin') }}" class="btn btn-default btn-sm">🏠 Dashboard</a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@include('layouts.app')
