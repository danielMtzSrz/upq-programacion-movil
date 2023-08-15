CREATE TABLE `failed_jobs` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL,
  `deleted_at` timestamp DEFAULT NULL
);

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint NOT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL
);

CREATE TABLE `model_has_roles` (
  `role_id` bigint NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint NOT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL,
  `deleted_at` timestamp DEFAULT NULL
);

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL,
  `deleted_at` timestamp DEFAULT NULL
);

CREATE TABLE `permissions` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `module_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL,
  `deleted_at` timestamp DEFAULT NULL
);

CREATE TABLE `personal_access_tokens` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp DEFAULT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL,
  `deleted_at` timestamp DEFAULT NULL
);

CREATE TABLE `roles` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL
);

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint NOT NULL,
  `role_id` bigint NOT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL,
  `deleted_at` timestamp DEFAULT NULL
);

CREATE TABLE `sessions` (
  `id` varchar(255) PRIMARY KEY,
  `user_id` bigint DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` text NOT NULL,
  `last_activity` int NOT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL,
  `deleted_at` timestamp DEFAULT NULL
);

CREATE TABLE `users` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `apellido_paterno` varchar(255),
  `apellido_materno` varchar(255),
  `name` varchar(255),
  `edad` bigint,
  `sexo` bigint,
  `estado_civil` bigint,
  `estado_nacimiento` bigint,
  `nacionalidad` bigint,
  `pertenece_comunidad_indigena` bool,
  `comunidades_indigenas_pertenecientes` varchar(255),
  `habla_lengua_indigena` bool,
  `lenguas_indigenas` varchar(255),
  `tiene_discapacidad` bool,
  `discapacidades` varchar(255),
  `ocupacion` varchar(255),
  `lugar_asiste` varchar(255),
  `cargo_puesto` varchar(255),
  `telefono` varchar(10),
  `email` varchar(255),
  `email_verified_at` timestamp DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text,
  `two_factor_recovery_codes` text,
  `two_factor_confirmed_at` timestamp DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL
);

CREATE TABLE `ListaAsistencia` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `id_evento` bigint,
  `id_usuario` bigint,
  `asistencia` bool,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL
);

CREATE TABLE `eventos` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `id_usuario` bigint,
  `nombre` varchar(255),
  `descripcion` varchar(255),
  `ubicacion` varchar(255),
  `fecha_evento` datetime,
  `capacidad` bigint,
  `registrados` bigint,
  `fotografia` varchar(255),
  `status` bool,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL
);

ALTER TABLE `ListaAsistencia` ADD FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

ALTER TABLE `eventos` ADD FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

ALTER TABLE `model_has_permissions` ADD FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

ALTER TABLE `model_has_roles` ADD FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
