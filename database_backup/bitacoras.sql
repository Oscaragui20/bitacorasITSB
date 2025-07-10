-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2025 a las 20:04:23
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bitacoras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

CREATE TABLE `bitacoras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `base_de_datos` varchar(100) DEFAULT NULL,
  `tabla_afectada` varchar(100) DEFAULT NULL,
  `descripcion_cambio` text NOT NULL,
  `justificacion` varchar(100) DEFAULT NULL,
  `solicitado_por` varchar(100) DEFAULT NULL,
  `autorizado_por` varchar(100) DEFAULT NULL,
  `fecha_ejecucion` date NOT NULL,
  `hora_ejecucion` time NOT NULL,
  `tipo_cambio` enum('insertar','actualizar','eliminar') DEFAULT NULL,
  `herramienta_usadas` varchar(100) DEFAULT NULL,
  `respaldo_previo` varchar(255) DEFAULT NULL,
  `estado_de_bitacoras` enum('pendiente','finalizado','eliminado') NOT NULL DEFAULT 'pendiente',
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bitacoras`
--

INSERT INTO `bitacoras` (`id`, `base_de_datos`, `tabla_afectada`, `descripcion_cambio`, `justificacion`, `solicitado_por`, `autorizado_por`, `fecha_ejecucion`, `hora_ejecucion`, `tipo_cambio`, `herramienta_usadas`, `respaldo_previo`, `estado_de_bitacoras`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, 'sistemas', 'estudiantes', 'borre de al estudiante del oscar de la tabla de estudiantes', 'por que si', 'ing.diego', 'ing.lucas', '2025-01-01', '12:32:00', 'eliminar', 'SQL DELETE', 'no se iso', 'finalizado', 2, '2025-07-02 10:36:56', '2025-07-02 10:37:45'),
(2, 'sistemas', 'estudiantes', 'borre de al estudiante del oscar de la tabla de estudiantes', 'por que si', 'ing.diego', 'ing.lucas', '2025-01-01', '12:34:00', 'eliminar', 'SQL DELETE', 'no se iso', 'finalizado', 2, '2025-07-02 17:21:38', '2025-07-02 22:40:07'),
(3, 'marqueti', 'estudiantes', 'borre de al estudiante del oscar de la tabla de estudiantes', 'por que si', 'ing.diego', 'ing.lucas', '2025-01-01', '12:34:00', 'actualizar', 'SQL DELETE', 'no se iso', 'finalizado', 1, '2025-07-02 17:23:52', '2025-07-02 22:40:47'),
(4, '123', 'f', 'gf', 'fg', 'gf', 'gf', '3432-03-12', '21:12:00', 'eliminar', 'fsda', 'no se hizo', 'pendiente', 1, '2025-07-02 22:56:35', '2025-07-02 22:56:35'),
(5, 'frsfsdfa', 'sdfasdfsdf', 'sdf', 'sdf', 'sdf', 'sfd', '4455-03-12', '12:04:00', 'actualizar', 'sadfsdf', 'fdsafds', 'finalizado', 1, '2025-07-02 23:08:10', '2025-07-02 23:37:01'),
(6, 'fgtsfdgsf', 'fdsgsdf', 'fgdsdfg', 'dfgdg', 'gfdgs', 'gfsdfggf', '4333-03-12', '12:34:00', 'eliminar', 'qwerq', 'qwqwewe', 'finalizado', 2, '2025-07-02 23:17:49', '2025-07-02 23:18:14'),
(7, 'fgtsfdgsf', 'estudiantes', 'fgdsdfg', 'fsdf', 'fsd', 'sfd', '1212-02-12', '12:34:00', 'actualizar', 'qwe', 'qw', 'finalizado', 2, '2025-07-02 23:21:07', '2025-07-02 23:22:03'),
(8, 'sdfsadf', 'sfadfsda', 'sdfasfa', 'sfadsf', 'sfdasdfa', 'sfadsfad', '4454-03-12', '12:34:00', 'eliminar', 'wfadf', 'sfdafs', 'finalizado', 2, '2025-07-02 23:32:16', '2025-07-02 23:32:30'),
(9, 'adfsfsdaf', 'sdffas', 'sdfaf', 'sdf', 'fsdsdf', 'sdf', '4222-03-12', '12:34:00', 'eliminar', 'fasdf', 'fsdaasfd', 'pendiente', 2, '2025-07-02 23:32:51', '2025-07-02 23:32:51'),
(10, NULL, 'fgd', 'sfd', 'fg', 'sdfa', 'fdg', '0012-12-21', '12:12:00', 'eliminar', 'sd', 'ds', 'pendiente', 2, '2025-07-02 23:51:15', '2025-07-02 23:51:15'),
(11, 'frsfsdfa', 'sdfa', 'sdfasfa', 'sdf', 'fs', 's', '0003-03-12', '11:11:00', 'eliminar', 'wre', 's', 'pendiente', 2, '2025-07-03 00:01:38', '2025-07-03 00:01:38'),
(12, 'sdfg', 'frsfsdfa', 'frsfsdfa', 'fsd', 'fsd', 'd', '3444-03-12', '12:33:00', 'eliminar', 'fsd', 'sdf', 'finalizado', 2, '2025-07-03 00:08:21', '2025-07-03 22:04:41'),
(13, 'd', 'd', 'd', 'd', 'd', 'd', '2222-02-11', '12:34:00', 'eliminar', 'fd', 'f sdfdsaf', 'pendiente', 1, '2025-07-03 00:16:10', '2025-07-03 00:16:10'),
(14, 'a', 'a', 'a', 'a', 'a', 'a', '2025-07-02', '12:04:00', 'eliminar', 'a', 'a', 'pendiente', 1, '2025-07-03 00:58:20', '2025-07-03 00:58:20'),
(15, 'a', 'a', 'a', 'a', 'a', 'a', '4444-03-12', '12:02:00', 'actualizar', 'as', 'a', 'pendiente', 1, '2025-07-03 00:59:01', '2025-07-03 00:59:01'),
(16, 'as', 'd', 'd', 'd', 'd', 'd', '2025-07-05', '12:03:00', 'actualizar', 'qw', 'w', 'eliminado', 2, '2025-07-03 22:06:25', '2025-07-04 00:40:39'),
(17, 'g', 'g', 'g', 'g', 'g', 'g', '5333-03-12', '12:34:00', 'eliminar', '2', '2', 'pendiente', 1, '2025-07-04 01:33:19', '2025-07-04 01:33:19'),
(18, 'as', 'a', 'a', 'a', 'a', 'a', '3333-03-12', '11:11:00', 'eliminar', '1', 'q', 'pendiente', 2, '2025-07-04 01:54:45', '2025-07-04 01:54:45'),
(19, 'as', 'a', 'a', 'a', 'a', 'a', '3444-02-12', '12:34:00', 'eliminar', 'a', 'a', 'pendiente', 2, '2025-07-04 01:55:02', '2025-07-04 01:55:02'),
(20, 'a', 's', 'sfd', 'sdfasfasf', 's', 's', '4444-03-12', '11:11:00', 'actualizar', 'a', 'a', 'pendiente', 2, '2025-07-04 01:55:37', '2025-07-04 01:55:37'),
(21, 'sistemas', 'estudiantes', 'borre de al estudiante del oscar de la tabla de estudiantes', 'por que si', 'ing.diego', 'ing.lucas', '1111-11-11', '11:11:00', 'eliminar', 'SQL DELETE', '11', 'eliminado', 1, '2025-07-07 05:42:54', '2025-07-08 00:13:34'),
(22, 'sistemas', 'estudiantes', 'borre de al estudiante del oscar de la tabla de estudiantes', 'por que si', 'ing.diego', 'ing.lucas', '2222-02-22', '22:22:00', 'insertar', 'SQL DELETE', '11', 'pendiente', 2, '2025-07-07 06:16:54', '2025-07-07 06:16:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_02_030739_create_usuarios_table', 1),
(6, '2025_07_02_030828_create_bitacoras_table', 1),
(7, '2025_07_03_193757_update_estado_en_bitacoras_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` enum('admin','usuario') NOT NULL DEFAULT 'usuario',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contraseña`, `rol`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$I3R0pFJU0ngeMz3ARoFINuq9O4Ijbx8FFtC4vsYV/KTpRv34yeIvm', 'admin', '2025-07-02 09:21:04', '2025-07-02 09:21:04'),
(2, 'juan', '$2y$12$KXCtIeLbFQOekPUW3tvpvuRN0P.n1G6k56Kdiu8lbgUXS8cZrQVQO', 'usuario', '2025-07-02 09:21:05', '2025-07-02 09:21:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bitacoras_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_nombre_unique` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD CONSTRAINT `bitacoras_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
