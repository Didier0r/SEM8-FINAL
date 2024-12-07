INSERT INTO roles (nombre, descripcion) VALUES
('Administrador', 'Control total del sistema'),
('Empleado', 'Usuario con acceso limitado'),

INSERT INTO usuarios (nombre, email, contrasena, rol_id) VALUES, 
('Carlos Ruiz', 'supervisor@empresa.com', MD5('Administrador'), 1),
('Ana Lopez', 'empleado1@empresa.com', MD5('empleado123'), 2);


INSERT INTO horarios (usuario_id, dia_semana, hora_entrada, hora_salida) VALUES
(2, 'Lunes', '09:00:00', '17:00:00'),
(2, 'Martes', '09:00:00', '17:00:00'),
(2, 'Miércoles', '09:00:00', '17:00:00'),
(2, 'Jueves', '09:00:00', '17:00:00'),
(2, 'Viernes', '09:00:00', '17:00:00'),
(3, 'Lunes', '08:00:00', '16:00:00'),
(3, 'Miércoles', '08:00:00', '16:00:00');

INSERT INTO asistencias (usuario_id, fecha, hora_entrada, hora_salida, ubicacion, comentarios) VALUES
(2, '2024-11-27', '09:10:00', '17:05:00', '{"lat": -12.046374, "lng": -77.042793}', 'Llegada con 10 minutos de retraso'),
(2, '2024-11-28', '09:00:00', '17:00:00', '{"lat": -12.046374, "lng": -77.042793}', 'Puntual'),
(3, '2024-11-27', '08:05:00', '16:10:00', '{"lat": -12.047274, "lng": -77.041893}', 'Entrada correcta');

INSERT INTO permisos (usuario_id, tipo, fecha_inicio, fecha_fin, estado, comentarios) VALUES
(2, 'Vacaciones', '2024-12-01', '2024-12-15', 'Aprobado', 'Vacaciones anuales'),
(3, 'Enfermedad', '2024-11-29', '2024-12-01', 'Pendiente', 'Reposo por gripe');

INSERT INTO configuraciones (clave, valor, descripcion) VALUES
('tolerancia_entrada', '15', 'Minutos de tolerancia para llegadas tarde'),
('dias_laborales', 'Lunes,Martes,Miércoles,Jueves,Viernes', 'Días laborales de la empresa'),
('email_contacto', 'soporte@empresa.com', 'Correo de soporte técnico'),
('vacaciones_anuales', '20', 'Días de vacaciones asignados anualmente'),
('modo_mantenimiento', '0', 'Modo mantenimiento: 1=Sí, 0=No');
