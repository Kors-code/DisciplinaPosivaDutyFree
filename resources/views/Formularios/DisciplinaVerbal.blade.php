<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Asesoramiento Verbal - Disciplina Positiva</title>
  <link rel="stylesheet" href="{{ asset('css/DisciplinaVerbal.css') }}">
  <style>
    /* mínimo estilo inline para que no rompa — ajusta o usa tu CSS */
    body{font-family: Arial,Helvetica,sans-serif; background:#101010; color:#fff;}
    .container{max-width:900px;margin:20px auto;padding:20px;background:#0f0f0f;border-radius:8px;}
    label{display:block;margin-bottom:6px;color:#ccc}
    input[type="text"], input[type="date"], input[type="time"], textarea {width:100%; padding:8px;border-radius:4px;border:1px solid #444;background:transparent;color:white}
    .row{display:flex;gap:12px}
    .row .col{flex:1}
    .submit{margin-top:12px}
    .btn{background:#840028;border:none;color:white;padding:10px 14px;border-radius:6px;cursor:pointer}
  </style>
</head>
<body>
  <div class="container">
    <h2 style="color:#840028;text-align:center">ASESORAMIENTO VERBAL</h2>
    
    <form action="{{ route('formulario.pdf') }}" method="POST">
      @csrf
      
      <div style="margin:12px 0">
        <label>Fecha de aplicación</label>
        <input type="date" name="fecha"  value="{{ old('fecha') }} required">
      </div>
      
      <div style="margin:12px 0" class="row">
        <div class="col">
          <label>Aplicada a:</label>
          <input type="text" name="nombre" required value="{{ old('nombre') }}">
        </div>
        <div class="col" style="max-width:220px">
          <label>Cédula</label>
          <input type="text" name="cedula" value="{{ old('cedula') }}">
        </div>
      </div>
      
      <div style="margin:12px 0">
        <label>Cargo</label>
        <input type="text" name="cargo" value="{{ old('cargo') }}">
      </div>
      
      <div style="margin:12px 0" class="row">
        <div class="col">
          <label>Realizada por:</label>
          <input type="text" name="jefe" value="{{ old('jefe') }}">
        </div>
        <div class="col" style="max-width:220px">
          <label>Cédula</label>
          <input type="text" name="jefe_cedula" value="{{ old('jefe_cedula') }}">
        </div>
      </div>

      <div style="margin:12px 0">
        <label>Cargo</label>
        <input type="text" name="cargo_jefe" value="{{ old('cargo_jefe') }}">
      </div>

      <hr style="border-color:#333">

      <h3 style="color:#ddd">Descripción del Asesoramiento</h3>

      <div style="margin:12px 0" class="row">
        <div class="col" style="max-width:220px">
          <label>Fecha del evento</label>
          <input type="date" name="fecha_evento" value="{{ old('fecha_evento') }}">
        </div>
        <div class="col" style="max-width:120px">
          <label>Hora</label>
          <input type="time" name="hora" value="{{ old('hora') }}">
        </div>
        <div class="col" style="max-width:120px">
          <label>Fase</label>
          <input type="text" name="fase" value="{{ old('fase') }}">
        </div>
        <div class="col" style="max-width:120px">
          <label>Grupo</label>
          <input type="text" name="grupo" value="{{ old('grupo') }}">
        </div>
      </div>

      <div style="margin:12px 0">
        <label>Orientación del Asesoramiento</label>
        <input type="text" name="orientacion" value="{{ old('orientacion') }}">
      </div>

      <div style="margin:12px 0">
  <label>Detalle <small>(máx. 480 caracteres)</small></label>
  <textarea id="detalle" name="detalle" rows="6" maxlength="480">{{ old('detalle') }}</textarea>
  <div id="contador" style="text-align:right;color:#999;font-size:12px">0 / 480</div>
</div>

<!-- Firma Empleado -->
<div style="margin:12px 0">
  <label>Firma Empleado</label>
  <div style="display:flex;gap:8px;align-items:center">
    <button type="button" id="abrirFirmaEmpleado" class="btn">Firmar aquí</button>
    <img id="imagenFirmaEmpleado" src="" style="display:none; max-width:200px; border:1px solid #444; border-radius:6px;">
    <button type="button" id="borrarFirmaEmpleado" style="background:#555;color:white;border:none;padding:8px;border-radius:6px">Borrar</button>
  </div>
  <input type="hidden" id="firmaEmpleadoBase64" name="firma_empleado">
</div>

<!-- Firma Jefe -->
<div style="margin:12px 0">
  <label>Firma Jefe</label>
  <div style="display:flex;gap:8px;align-items:center">
    <button type="button" id="abrirFirmaJefe" class="btn">Firmar aquí</button>
    <img id="imagenFirmaJefe" src="" style="display:none; max-width:200px; border:1px solid #444; border-radius:6px;">
    <button type="button" id="borrarFirmaJefe" style="background:#555;color:white;border:none;padding:8px;border-radius:6px">Borrar</button>
  </div>
  <input type="hidden" id="firmaJefeBase64" name="firma_jefe">
</div>

<!-- Modal Firma -->
<div id="modalFirma" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.7);align-items:center;justify-content:center;z-index:9999">
  <div style="background:#fff;padding:20px;border-radius:8px;max-width:760px;width:95%;text-align:center">
    <h3 id="tituloModalFirma">Firme con el mouse o dedo</h3>
    <canvas id="canvasFirma" width="700" height="200" style="border:2px solid #840028;border-radius:6px;background:white"></canvas>
    <div style="margin-top:12px;display:flex;gap:8px;justify-content:center">
      <button id="guardarFirma" style="background:#840028">Guardar</button>
      <button id="limpiarFirma" style="background:#555">Limpiar</button>
      <button id="cerrarFirma" style="background:#B71C1C">Cerrar</button>
    </div>
  </div>
</div>
  
  <div class="submit">
    <button type="submit" class="btn">Generar PDF</button>
  </div>
</form>
</div>
  <script>
    // --- Contador de caracteres ---
    const textarea = document.getElementById('detalle');
    const contador = document.getElementById('contador');
    const max = parseInt(textarea.getAttribute('maxlength'));
    
    function actualizarContador() {
      const longitud = textarea.value.length;
    contador.textContent = `${longitud} / ${max}`;
    if (longitud >= max) {
      contador.style.color = '#f66'; // rojo cuando se llega al máximo
    } else {
      contador.style.color = '#999';
    }
  }

  textarea.addEventListener('input', actualizarContador);
  // inicializar al cargar la página
  actualizarContador();
   const modalFirma = document.getElementById('modalFirma');
  const canvas = document.getElementById('canvasFirma');
  const ctx = canvas.getContext('2d');
  const guardarFirma = document.getElementById('guardarFirma');
  const limpiarFirma = document.getElementById('limpiarFirma');
  const cerrarFirma = document.getElementById('cerrarFirma');
  const tituloModal = document.getElementById('tituloModalFirma');

  let tipoFirma = null; // "empleado" o "jefe"
  let drawing = false;

  // Iniciar canvas con fondo blanco
  function initCanvas() {
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0,0,canvas.width,canvas.height);
    ctx.strokeStyle = '#000';
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
  }

  function openModal(tipo) {
    tipoFirma = tipo;
    tituloModal.textContent = tipo === 'empleado' ? 'Firma del Empleado' : 'Firma del Jefe';
    initCanvas();
    modalFirma.style.display = 'flex';
  }

  function closeModal() {
    modalFirma.style.display = 'none';
  }

  // Obtener posición en canvas
  function getPos(e){
    const rect = canvas.getBoundingClientRect();
    let clientX, clientY;
    if (e.touches && e.touches.length) { clientX = e.touches[0].clientX; clientY = e.touches[0].clientY; }
    else { clientX = e.clientX; clientY = e.clientY; }
    return { x: clientX - rect.left, y: clientY - rect.top };
  }

  // Dibujo
  canvas.addEventListener('mousedown', e => { drawing = true; const p = getPos(e); ctx.beginPath(); ctx.moveTo(p.x, p.y); });
  canvas.addEventListener('mousemove', e => { if(!drawing) return; const p = getPos(e); ctx.lineTo(p.x, p.y); ctx.stroke(); });
  canvas.addEventListener('mouseup', () => { drawing = false; });
  canvas.addEventListener('mouseleave', () => { drawing = false; });
  canvas.addEventListener('touchstart', e => { e.preventDefault(); drawing = true; const p = getPos(e); ctx.beginPath(); ctx.moveTo(p.x, p.y); }, {passive:false});
  canvas.addEventListener('touchmove', e => { e.preventDefault(); if(!drawing) return; const p = getPos(e); ctx.lineTo(p.x, p.y); ctx.stroke(); }, {passive:false});
  canvas.addEventListener('touchend', () => { drawing = false; });

  limpiarFirma.addEventListener('click', () => initCanvas());
  cerrarFirma.addEventListener('click', closeModal);

  guardarFirma.addEventListener('click', () => {
    const dataUrl = canvas.toDataURL('image/png');
    if (tipoFirma === 'empleado') {
      document.getElementById('imagenFirmaEmpleado').src = dataUrl;
      document.getElementById('imagenFirmaEmpleado').style.display = 'block';
      document.getElementById('firmaEmpleadoBase64').value = dataUrl;
    } else if (tipoFirma === 'jefe') {
      document.getElementById('imagenFirmaJefe').src = dataUrl;
      document.getElementById('imagenFirmaJefe').style.display = 'block';
      document.getElementById('firmaJefeBase64').value = dataUrl;
    }
    closeModal();
  });

  // Botones abrir/borrar
  document.getElementById('abrirFirmaEmpleado').addEventListener('click', () => openModal('empleado'));
  document.getElementById('abrirFirmaJefe').addEventListener('click', () => openModal('jefe'));

  document.getElementById('borrarFirmaEmpleado').addEventListener('click', () => {
    document.getElementById('imagenFirmaEmpleado').style.display = 'none';
    document.getElementById('firmaEmpleadoBase64').value = '';
  });
  document.getElementById('borrarFirmaJefe').addEventListener('click', () => {
    document.getElementById('imagenFirmaJefe').style.display = 'none';
    document.getElementById('firmaJefeBase64').value = '';
  });

  initCanvas();
  </script>
</body>
</html>
