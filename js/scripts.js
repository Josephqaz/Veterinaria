document.addEventListener('DOMContentLoaded', function() {
    loadMascotas();
    loadServicios();

    document.getElementById('idMascota').addEventListener('change', function() {
        const idMascota = this.value;
        if (idMascota) {
            loadRecordatorios(idMascota);
        } else {
            clearRecordatorios();
        }
    });
});

function loadMascotas() {
    fetch('../Backend/get_mascotas.php')
        .then(response => response.json())
        .then(data => {
            const mascotaSelect = document.getElementById('idMascota');
            data.forEach(mascota => {
                const option = document.createElement('option');
                option.value = mascota.idMascota;
                option.textContent = `${mascota.nombre} (${mascota.especie})`;
                mascotaSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar mascotas:', error));
}

function loadServicios() {
    fetch('../Backend/get_servicios.php')
        .then(response => response.json())
        .then(data => {
            const servicioSelect = document.getElementById('tipoServicio');
            data.forEach(servicio => {
                const option = document.createElement('option');
                option.value = servicio.idServicio;
                option.textContent = `${servicio.nombre} ($${servicio.costo})`;
                servicioSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar servicios:', error));
}

function loadRecordatorios(idMascota) {
    fetch(`../Backend/get_recordatorios.php?idMascota=${idMascota}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error del servidor:', data.error);
                return;
            }
            const tbody = document.getElementById('recordatoriosTableBody');
            tbody.innerHTML = '';
            data.forEach(recordatorio => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${recordatorio.idRecordatorio}</td>
                    <td>${recordatorio.fecha}</td>
                    <td>${recordatorio.descripcion}</td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar recordatorios:', error));
}

function clearRecordatorios() {
    document.getElementById('recordatoriosTableBody').innerHTML = '';
}

/*==================================================================================*/

document.addEventListener('DOMContentLoaded', function() {
    loadClientes();

    document.getElementById('idCliente').addEventListener('change', function() {
        cargarMascotasHistorial();
    });

    document.getElementById('idMascota').addEventListener('change', function() {
        cargarHistorialClinico();
    });
});

function loadClientes() {
    fetch('../Backend/get_clientes.php')
        .then(response => response.json())
        .then(data => {
            const clienteSelect = document.getElementById('idCliente');
            data.forEach(cliente => {
                const option = document.createElement('option');
                option.value = cliente.idCliente;
                option.textContent = cliente.nombre;
                clienteSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar clientes:', error));
}

function cargarMascotasHistorial() {
    const idCliente = document.getElementById('idCliente').value;
    if (idCliente) {
        fetch('../Backend/get_mascotas.php?idCliente=' + idCliente)
            .then(response => response.json())
            .then(data => {
                const mascotaSelect = document.getElementById('idMascota');
                mascotaSelect.innerHTML = '<option value="">Seleccione una mascota</option>';
                data.forEach(mascota => {
                    const option = document.createElement('option');
                    option.value = mascota.idMascota;
                    option.textContent = mascota.nombre;
                    mascotaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar las mascotas:', error));
    } else {
        clearHistorialClinico();
    }
}

function cargarHistorialClinico() {
    const idMascota = document.getElementById('idMascota').value;
    if (idMascota) {
        fetch('../Backend/get_historial_clinico.php?idMascota=' + idMascota)
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('historialClinicoTableBody');
                tbody.innerHTML = '';
                data.forEach(historial => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${historial.idHistorial}</td>
                        <td>${historial.fecha}</td>
                        <td>${historial.descripcion}</td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => console.error('Error al cargar el historial clínico:', error));
    } else {
        clearHistorialClinico();
    }
}

function clearHistorialClinico() {
    document.getElementById('historialClinicoTableBody').innerHTML = '';
}

