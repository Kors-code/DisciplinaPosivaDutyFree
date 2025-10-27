<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Asesoramiento Verbal - Disciplina Positiva</title>

  <style>
    /* ---------- Variables y reset ligero (mobile-first) ---------- */
    :root{
      --primary: #840028;
      --primary-dark: #6b0021;
      --bg: #071018;
      --card-bg: rgba(255,255,255,0.02);
      --muted: #b7c0c7;
      --glass: rgba(255,255,255,0.03);
      --input-border: rgba(255,255,255,0.06);
      --radius: 12px;
      --shadow: 0 10px 30px rgba(2,6,10,0.6);
    }
    *{box-sizing:border-box;margin:0;padding:0}
    html,body{height:100%}
    body{
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background:
        radial-gradient(600px 300px at 10% 10%, rgba(132,0,40,0.04), transparent 6%),
        radial-gradient(400px 200px at 90% 90%, rgba(132,0,40,0.02), transparent 6%),
        var(--bg);
      color:#eaf6ff;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      padding:16px;
      line-height:1.35;
      font-size:15px;
    }

    /* ---------- Alert box ---------- */
 .alert {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #4CAF50;
    color: white;
    padding: 14px 28px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    font-family: Arial, sans-serif;
    font-size: 16px;
    opacity: 0;
    z-index: 9999;
    animation: fadeIn 0.5s forwards, fadeOut 0.5s forwards 3.5s;
}

.alert-link {
    color: #fff;
    text-decoration: underline;
    margin-left: 10px;
    font-weight: bold;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translate(-50%, -10px); }
    to { opacity: 1; transform: translate(-50%, 0); }
}

@keyframes fadeOut {
    from { opacity: 1; transform: translate(-50%, 0); }
    to { opacity: 0; transform: translate(-50%, -10px); }
}

/* Animaciones */
@keyframes fadeIn {
    from { opacity: 0; transform: translate(-50%, -10px); }
    to { opacity: 1; transform: translate(-50%, 0); }
}

@keyframes fadeOut {
    from { opacity: 1; transform: translate(-50%, 0); }
    to { opacity: 0; transform: translate(-50%, -10px); }
}


    /* ---------- Wrapper ---------- */
    .wrap{max-width:1100px;margin:0 auto}

    /* ---------- Header ---------- */
    header{display:flex;align-items:center;gap:12px;margin-bottom:12px}
    .logo{
      width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,var(--primary),var(--primary-dark));
      display:flex;align-items:center;justify-content:center;font-weight:700;color:white;font-size:18px;
      box-shadow:0 6px 18px rgba(132,0,40,0.18)
    }
    .brand h1{font-size:18px;color:var(--primary);margin-bottom:2px}
    .brand p{color:var(--muted);font-size:13px;margin:0}

    /* ---------- Card & Grid (mobile-first: single column) ---------- */
    .card{
      background:var(--card-bg);border-radius:14px;padding:14px;border:1px solid rgba(255,255,255,0.03);box-shadow:var(--shadow);
    }
    form.grid{
      display:grid;
      grid-template-columns: 1fr;
      gap:14px;
    }

    /* ---------- Fields ---------- */
    .field{margin-bottom:10px}
    label{display:block;color:var(--muted);font-size:13px;margin-bottom:6px}
    input[type="text"], input[type="date"], input[type="time"], textarea{
      width:100%;padding:10px 12px;border-radius:10px;background:transparent;border:1px solid var(--input-border);color:#eaf6ff;
      font-size:15px;outline:none;backdrop-filter: blur(2px)
    }
    input::placeholder, textarea::placeholder { color: #8f9aa3 }
    input:focus, textarea:focus { box-shadow: 0 6px 18px rgba(132,0,40,0.09); border-color: rgba(132,0,40,0.45) }
    textarea{min-height:110px;resize:vertical}

    .row{display:flex;gap:10px;flex-wrap:wrap}
    .col{flex:1;min-width:140px}
    .w180{width:180px;min-width:120px}

    /* ---------- Buttons ---------- */
    .btn{
      display:inline-flex;align-items:center;gap:8px;padding:9px 14px;border-radius:10px;background:linear-gradient(90deg,var(--primary),var(--primary-dark));
      color:#fff;border:none;cursor:pointer;font-weight:600;
    }
    .btn.secondary{background:transparent;border:1px solid rgba(255,255,255,0.06);color:var(--primary)}
    .small{font-size:13px;color:var(--muted)}

    /* ---------- Separators & footer ---------- */
    hr.sep{border:none;height:1px;background:linear-gradient(90deg,transparent, rgba(255,255,255,0.03), transparent);margin:12px 0;border-radius:4px}
    .form-footer{display:flex;align-items:center;justify-content:space-between;gap:8px;flex-wrap:wrap;margin-top:6px}

    /* ---------- Sign boxes ---------- */
    .sign-row{display:flex;gap:10px;flex-wrap:wrap}
    .sign-box{flex:1;min-width:180px;background:rgba(255,255,255,0.01);padding:10px;border-radius:10px;border:1px dashed rgba(255,255,255,0.03)}
    .sign-box img{max-width:100%;height:auto;border-radius:6px;display:block}

    /* ---------- Loader spinner ---------- */
    .spinner{display:inline-block;width:18px;height:18px;border-radius:50%;border:2px solid rgba(255,255,255,0.12);border-top-color:var(--primary);animation:spin .8s linear infinite}
    @keyframes spin{to{transform:rotate(360deg)}}

    /* ---------- Responsive: tablet and desktop ---------- */
    @media (min-width: 801px){
      form.grid{grid-template-columns: 1fr 340px;gap:20px}
      .logo{width:56px;height:56px;font-size:20px}
    }
    @media (min-width: 1100px){
      .wrap{max-width:1200px}
    }

    /* ---------- Very small screens tweaks ---------- */
    @media (max-width:360px){
      body{padding:10px;font-size:14px}
      .w180{width:140px}
      .logo{width:44px;height:44px}
      input,textarea{padding:10px}
      .btn{padding:8px 12px}
    }

    /* ---------- Accessibility focus ---------- */
    :focus{outline: 3px solid rgba(132,0,40,0.12);outline-offset:2px}
  </style>
</head>
<body>
   @if (session('success'))
    <div class="alert">
        {{ session('success') }}
        @if (session('pdf_path'))
            <a href="{{ route('descargar.pdf', ['path' => session('pdf_path')]) }}" class="alert-link">
                Descargar PDF
            </a>
        @endif
    </div>
@endif

@if ($errors->any())
<div class="alert" style="background-color:#ff4d4d;">
    <ul style="list-style:none; margin:0; padding:0;">
        @foreach ($errors->all() as $error)
            <li class="alert-link">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


  <div class="wrap">
    <header style="margin-bottom:10px;align-items:center;display:flex;gap:10px;">
      <div class="logo">DP</div>
      <div class="brand">
        <h1>Disciplina Positiva</h1>
        <p>Asesoramiento Verbal — Generador de actas</p>
      </div>
      <div style="margin-left:auto;font-size:13px;color:var(--muted)">{{ date('Y') }}</div>
    </header>

    <div class="card" role="region" aria-label="Formulario Asesoramiento Verbal">
      <form class="grid" action="{{ route('formulario.pdf') }}" method="POST" novalidate>
        @csrf

        <!-- Panel principal (columna 1) -->
        <div>
          <div class="field">
            <label for="fecha">Fecha de aplicación</label>
            <input id="fecha" type="text" name="fecha"
                  value="{{ now()->format('Y-m-d H:i') }}" readonly
                  class="input-fecha">
          </div>


          <div class="row" style="align-items:flex-end">
            <div class="col">
              <div class="field">
                <label for="nombre">Aplicada a</label>
                <input id="nombre" type="text" name="nombre" required value="{{ old('nombre') }}" autocomplete="name" readonly>
              </div>
            </div>

            <div class="w180">
              <div class="field">
                <label for="cedula">Cédula</label>
                <div style="display:flex;gap:8px;align-items:center">
                  <input id="cedula" type="text" name="cedula" value="{{ old('cedula') }}" placeholder="1036..." style="flex:1" autocomplete="off" inputmode="numeric" required>
                  <div id="loaderEmpleado" aria-hidden="true" style="width:36px;display:flex;align-items:center;justify-content:center"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="field">
            <label for="cargo">Cargo</label>
            <input id="cargo" type="text" name="cargo" value="{{ old('cargo') }}" autocomplete="organization" readonly>
          </div>

          <hr class="sep">

          <h3 style="color:var(--primary);margin:0 0 10px 0">Descripción del Asesoramiento</h3>

          <div class="row">
            <div class="w180">
              <div class="field">
                <label for="fecha_evento">Fecha del evento</label>
                <input id="fecha_evento" type="date" name="fecha_evento" value="{{ old('fecha_evento') }}" required>
              </div>
            </div>

            <div class="w180">
              <div class="field">
                <label for="hora">Hora</label>
                <input id="hora" type="time" name="hora" value="{{ old('hora') }}">
              </div>
            </div>

            <div class="col">
              <div class="field">
                <label for="fase">Fase</label>
                <input id="fase" type="text" name="fase" value="{{ old('fase') }}" >
              </div>
            </div>

            <div class="w180">
              <div class="field">
                <label for="grupo">Grupo</label>
                <input id="grupo" type="text" name="grupo" value="{{ old('grupo') }}" required>
              </div>
            </div>
          </div>

          <div class="field">
            <label for="orientacion">Orientación del Asesoramiento</label>
            <input id="orientacion" type="text" name="orientacion" value="{{ old('orientacion') }}">
          </div>

          <div class="field">
            <label for="detalle">Detalle <small class="small">máx. 480 caracteres</small></label>
            <textarea id="detalle" name="detalle" maxlength="480" required>{{ old('detalle') }}</textarea>
            <div id="contador" class="small" style="text-align:right;margin-top:6px">0 / 480</div>
          </div>

          
        </div>

        <!-- Panel lateral (columna 2) -->
        <aside>
          <div class="field">
            <label for="jefe">Realizada por</label>
            <input id="jefe" type="text" name="jefe" value="{{ old('jefe') }}" autocomplete="name" readonly>
          </div>

          <div class="field">
            <label for="jefe_cedula">Cédula del responsable</label>
            <div style="display:flex;gap:8px;align-items:center">
              <input id="jefe_cedula" type="text" name="jefe_cedula" value="{{ old('jefe_cedula') }}" placeholder="1036..." style="flex:1" autocomplete="off" inputmode="numeric" required>
              <div id="loaderJefe" aria-hidden="true" style="width:36px;display:flex;align-items:center;justify-content:center"></div>
            </div>
          </div>

          <div class="field">
            <label for="cargo_jefe">Cargo (responsable)</label>
            <input id="cargo_jefe" type="text" name="cargo_jefe" value="{{ old('cargo_jefe') }}" readonly>
          </div>

          <hr class="sep">

          <h4 style="color:var(--primary);margin:0 0 10px 0">Firmas</h4>
          <div class="sign-row">
            <div class="sign-box" aria-label="Firma empleado">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
                <strong class="small">Firma Empleado</strong>
                <div style="display:flex;gap:8px">
                  <button type="button" id="abrirFirmaEmpleado" class="btn secondary">Firmar</button>
                  <button type="button" id="borrarFirmaEmpleado" class="btn secondary">Borrar</button>
                </div>
              </div>
              <img id="imagenFirmaEmpleado" src="" alt="Firma empleado" style="display:none">
              <input type="hidden" id="firmaEmpleadoBase64" name="firma_empleado">
            </div>

            <div class="sign-box" aria-label="Firma responsable">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
                <strong class="small">Firma Responsable</strong>
                <div style="display:flex;gap:8px">
                  <button type="button" id="abrirFirmaJefe" class="btn secondary">Firmar</button>
                  <button type="button" id="borrarFirmaJefe" class="btn secondary">Borrar</button>
                </div>
              </div>
              <img id="imagenFirmaJefe" src="" alt="Firma responsable" style="display:none">
              <input type="hidden" id="firmaJefeBase64" name="firma_jefe">
            </div>
          </div>
          <div class="form-footer" style="margin-top:8px">
            <div class="note small">Revisa los datos antes de generar el PDF</div>
            <button type="submit" class="btn">Generar PDF</button>
          </div>
        </aside>
      </form>
    </div>
  </div>

  <!-- Modal firma -->
  <div id="modalFirma" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);align-items:center;justify-content:center;z-index:9999">
    <div style="background:#fff;padding:14px;border-radius:10px;max-width:720px;width:94%;text-align:center">
      <h3 id="tituloModalFirma" style="color:var(--primary);margin-bottom:10px">Firme con el mouse o dedo</h3>
      <canvas id="canvasFirma" width="680" height="180" style="border:2px solid rgba(132,0,40,0.12);border-radius:8px;background:#fff"></canvas>
      <div style="margin-top:10px;display:flex;gap:8px;justify-content:center;flex-wrap:wrap">
        <button id="guardarFirma" class="btn">Guardar</button>
        <button id="limpiarFirma" class="btn secondary">Limpiar</button>
        <button id="cerrarFirma" class="btn secondary">Cerrar</button>
      </div>
    </div>
  </div>

  <script>
    /* ---------- Contador de caracteres ---------- */
    (function(){
      const textarea = document.getElementById('detalle');
      const contador = document.getElementById('contador');
      if (!textarea) return;
      function actualizarContador() {
        const max = parseInt(textarea.getAttribute('maxlength') || 480);
        const longitud = textarea.value.length;
        contador.textContent = `${longitud} / ${max}`;
        contador.style.color = longitud >= max ? 'rgba(255,80,80,0.95)' : 'var(--muted)';
      }
      textarea.addEventListener('input', actualizarContador);
      actualizarContador();
    })();

    /* ---------- Firma canvas (touch + mouse) ---------- */
    (function(){
      const modal = document.getElementById('modalFirma');
      const canvas = document.getElementById('canvasFirma');
      const ctx = canvas.getContext('2d');
      const abrirFirmaEmpleado = document.getElementById('abrirFirmaEmpleado');
      const abrirFirmaJefe = document.getElementById('abrirFirmaJefe');
      const guardarFirma = document.getElementById('guardarFirma');
      const limpiarFirma = document.getElementById('limpiarFirma');
      const cerrarFirma = document.getElementById('cerrarFirma');
      let tipoFirma = null;
      let drawing = false;

      function initCanvas(){
        ctx.fillStyle = '#fff'; ctx.fillRect(0,0,canvas.width,canvas.height);
        ctx.strokeStyle = '#000'; ctx.lineWidth = 2; ctx.lineCap = 'round';
      }
      function openModal(tipo){
        tipoFirma = tipo;
        document.getElementById('tituloModalFirma').textContent = tipo === 'empleado' ? 'Firma Empleado' : 'Firma Responsable';
        initCanvas();
        modal.style.display = 'flex';
      }
      function closeModal(){ modal.style.display = 'none'; }

      function getPos(e){
        const rect = canvas.getBoundingClientRect();
        let clientX, clientY;
        if (e.touches && e.touches.length){ clientX = e.touches[0].clientX; clientY = e.touches[0].clientY; }
        else { clientX = e.clientX; clientY = e.clientY; }
        return { x: clientX - rect.left, y: clientY - rect.top };
      }

      canvas.addEventListener('mousedown', e => { drawing=true; const p=getPos(e); ctx.beginPath(); ctx.moveTo(p.x,p.y); });
      canvas.addEventListener('mousemove', e => { if(!drawing) return; const p=getPos(e); ctx.lineTo(p.x,p.y); ctx.stroke(); });
      window.addEventListener('mouseup', ()=> drawing=false);
      canvas.addEventListener('touchstart', e => { e.preventDefault(); drawing=true; const p=getPos(e); ctx.beginPath(); ctx.moveTo(p.x,p.y); }, {passive:false});
      canvas.addEventListener('touchmove', e => { e.preventDefault(); if(!drawing) return; const p=getPos(e); ctx.lineTo(p.x,p.y); ctx.stroke(); }, {passive:false});
      window.addEventListener('touchend', ()=> drawing=false);

      abrirFirmaEmpleado.addEventListener('click', ()=> openModal('empleado'));
      abrirFirmaJefe.addEventListener('click', ()=> openModal('jefe'));
      limpiarFirma.addEventListener('click', initCanvas);
      cerrarFirma.addEventListener('click', closeModal);

      guardarFirma.addEventListener('click', ()=>{
        const dataUrl = canvas.toDataURL('image/png');
        if (tipoFirma === 'empleado'){
          document.getElementById('imagenFirmaEmpleado').src = dataUrl;
          document.getElementById('imagenFirmaEmpleado').style.display = 'block';
          document.getElementById('firmaEmpleadoBase64').value = dataUrl;
        } else {
          document.getElementById('imagenFirmaJefe').src = dataUrl;
          document.getElementById('imagenFirmaJefe').style.display = 'block';
          document.getElementById('firmaJefeBase64').value = dataUrl;
        }
        closeModal();
      });

      // borrar botones
      document.getElementById('borrarFirmaEmpleado').addEventListener('click', ()=>{
        document.getElementById('imagenFirmaEmpleado').style.display='none';
        document.getElementById('firmaEmpleadoBase64').value='';
      });
      document.getElementById('borrarFirmaJefe').addEventListener('click', ()=>{
        document.getElementById('imagenFirmaJefe').style.display='none';
        document.getElementById('firmaJefeBase64').value='';
      });

      initCanvas();
    })();

    /* ---------- Buscar por cédula (debounce + loader) ---------- */
    (function(){
      const cedulaInput = document.getElementById('cedula');
      const nombreInput = document.getElementById('nombre');
      const cargoInput = document.getElementById('cargo');
      const loaderEmpleado = document.getElementById('loaderEmpleado');

      const jefeCedulaInput = document.getElementById('jefe_cedula');
      const jefeNombreInput = document.getElementById('jefe');
      const jefeCargoInput = document.getElementById('cargo_jefe');
      const loaderJefe = document.getElementById('loaderJefe');

      function debounce(fn, delay){
        let timer;
        return (...args) => { clearTimeout(timer); timer = setTimeout(()=> fn(...args), delay); };
      }

      async function fetchEmpleado(cedula, loaderEl){
        if(!cedula) return null;
        loaderEl.innerHTML = '<span class="spinner" aria-hidden="true"></span>';
        try{
          const res = await fetch(`/buscar-empleado/${encodeURIComponent(cedula)}`);
          if(!res.ok) return null;
          const data = await res.json();
          return data;
        } catch(e){
          console.error(e);
          return null;
        } finally {
          loaderEl.innerHTML = '';
        }
      }

      const handleEmpleado = debounce(async () => {
        const ced = cedulaInput.value.trim();
        if(!ced){ nombreInput.value=''; cargoInput.value=''; return; }
        const data = await fetchEmpleado(ced, loaderEmpleado);
        if(data && data.success){
          nombreInput.value = data.nombre || '';
          cargoInput.value = data.cargo || '';
        } else {
          nombreInput.value = '';
          cargoInput.value = '';
        }
      }, 550);

      const handleJefe = debounce(async () => {
        const ced = jefeCedulaInput.value.trim();
        if(!ced){ jefeNombreInput.value=''; jefeCargoInput.value=''; return; }
        const data = await fetchEmpleado(ced, loaderJefe);
        if(data && data.success){
          jefeNombreInput.value = data.nombre || '';
          jefeCargoInput.value = data.cargo || '';
        } else {
          jefeNombreInput.value = '';
          jefeCargoInput.value = '';
        }
      }, 550);

      // events: input (live) and blur (paste fallback)
      cedulaInput.addEventListener('input', handleEmpleado);
      cedulaInput.addEventListener('blur', handleEmpleado);

      jefeCedulaInput.addEventListener('input', handleJefe);
      jefeCedulaInput.addEventListener('blur', handleJefe);
    })();
  </script>
  <script>
document.addEventListener("DOMContentLoaded", () => {
    const alert = document.getElementById("alert");
    if (alert) {
        setTimeout(() => {
            alert.style.display = "none";
        }, 4000); // 4 segundos
    }
});
</script>
</body>
</html>
