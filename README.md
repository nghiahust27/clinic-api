# Clinic API

Backend API cho hệ thống quản lý phòng khám, được xây dựng bằng Laravel và PostgreSQL, chạy trong Docker.

## 1. Công nghệ sử dụng

- PHP
- Laravel
- PostgreSQL 16
- Docker Engine
- Docker Compose
- Laravel Sanctum
- PayPal Sandbox

## 2. Yêu cầu môi trường

- Ubuntu 24.04
- Docker Engine
- Docker Compose Plugin

Kiểm tra phiên bản Docker:

```bash
docker --version
docker compose version
```

## 3. Cấu trúc Docker

Project sử dụng Docker Compose với 2 service chính:

- `app`: Laravel / PHP Application
- `db`: PostgreSQL 16

Port ứng dụng:

```text
http://localhost:8000
```

Database PostgreSQL được persist bằng Docker volume để dữ liệu không bị mất khi container được recreate.

## 4. Cài đặt và chạy project

Clone project:

```bash
git clone <REPOSITORY_URL>
cd clinic-api
```

Tạo file `.env` từ file mẫu:

```bash
cp .env.example .env
```

Khởi động Docker và build image:

```bash
docker compose up -d --build
```

Kiểm tra trạng thái các container:

```bash
docker compose ps
```

Sau khi container chạy thành công, Laravel API có thể được truy cập tại:

```text
http://localhost:8000
```

## 5. Cấu hình Environment

Không commit file `.env` lên GitHub.

Copy file `.env.example` thành `.env`:

```bash
cp .env.example .env
```

Các biến môi trường chính:

```env
APP_NAME=Clinic
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=clinic
DB_USERNAME=clinic
DB_PASSWORD=linic_password

EXAMINATION_FEE=500000

PAYPAL_MODE=sandbox
PAYPAL_CLIENT_ID=<your_paypal_client_id>
PAYPAL_CLIENT_SECRET=<your_paypal_client_secret>
PAYPAL_CURRENCY=USD
```
Không commit các thông tin nhạy cảm lên GitHub:

```text
.env
PAYPAL_CLIENT_SECRET
Database credentials
```

## 6. Database Migration và Seeding

Sau khi Docker đã chạy, thực hiện migration và seed database:

```bash
docker compose exec app php artisan migrate --seed
```

Trong quá trình development, có thể reset toàn bộ database và chạy lại migration cùng seed:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

Lệnh `migrate:fresh --seed` sẽ xóa toàn bộ bảng hiện tại, tạo lại database schema và chạy toàn bộ Seeder.

## 7. Kết nối Laravel với PostgreSQL

Laravel kết nối tới PostgreSQL thông qua Docker service `db`.
```

Trong Docker network, Laravel không sử dụng `localhost` để kết nối tới PostgreSQL. Laravel sử dụng tên service:

```text
DB_HOST=db
```

PostgreSQL sử dụng port mặc định:

```text
5432
```

Kiểm tra PostgreSQL container:

```bash
docker compose ps
```

Kết nối trực tiếp tới PostgreSQL:

```bash
docker compose exec db psql -U clinic -d clinic
```

Chạy migration bên trong Laravel container:

```bash
docker compose exec app php artisan migrate
```

## 8. RBAC

Project sử dụng mô hình Role-Based Access Control (RBAC) để quản lý quyền truy cập của người dùng.

RBAC cho phép hệ thống xác định người dùng được phép thực hiện hành động nào dựa trên role của người dùng.

Các role trong hệ thống:

```text
ADMIN
RECEPTIONIST
DOCTOR
PHARMACIST
CASHIER
```

Hệ thống sử dụng 3 bảng chính cho RBAC:

```text
roles
permissions
role_permissions
```

Ngoài ra, mỗi user được gắn với một role thông qua:

```text
users.role_id -> roles.id
```

Mỗi user chỉ có đúng một role.

## 9. Roles

Bảng `roles` chứa thông tin role:

```text
id
name
display_name
```

Các role được seed:

```text
ADMIN
RECEPTIONIST
DOCTOR
PHARMACIST
CASHIER
```

Mỗi role có `display_name` để hiển thị tên thân thiện trong ứng dụng.

## 10. Permissions

Bảng `permissions` chứa danh sách các quyền của hệ thống:

```text
id
name
display_name
```

Tên permission sử dụng format:

```text
CONTROLLER.ACTION
```

Ví dụ:

```text
USERS.FINDALL
USERS.CREATE
USERS.FINDONE
USERS.UPDATE
USERS.DELETE
PATIENTS.FINDALL
PATIENTS.CREATE
APPOINTMENTS.UPDATESTATUS
MEDICINES.ADJUSTSTOCK
PAYMENTS.CAPTURE
STATS.SHOW
```

Các action được quy ước thành permission như sau:

```text
index        -> FINDALL
store        -> CREATE
show         -> FINDONE
update       -> UPDATE
destroy      -> DELETE
updateStatus -> UPDATESTATUS
addItem      -> ADDITEM
updateItem   -> UPDATEITEM
removeItem   -> REMOVEITEM
capture      -> CAPTURE
adjustStock  -> ADJUSTSTOCK
```

Ví dụ:

```text
UserController@index
        ↓
USERS.FINDALL

UserController@store
        ↓
USERS.CREATE

PatientController@show
        ↓
PATIENTS.FINDONE

PaymentController@capture
        ↓
PAYMENTS.CAPTURE
```

## 12. Role và Permission Mapping

### ADMIN

ADMIN có toàn bộ permission trong hệ thống.

Có quyền quản lý:

- User
- Role
- Chuyên khoa
- Bác sĩ
- Bệnh nhân
- Lịch khám
- Phiếu khám
- Thuốc
- Đơn thuốc
- Hóa đơn
- Thanh toán
- Thống kê

### RECEPTIONIST

RECEPTIONIST có quyền:

- Xem bệnh nhân
- Tạo bệnh nhân
- Xem chi tiết bệnh nhân
- Cập nhật bệnh nhân
- Xem bác sĩ
- Xem chuyên khoa
- Xem lịch khám
- Tạo lịch khám
- Xem chi tiết lịch khám
- Cập nhật lịch khám
- Cập nhật trạng thái lịch khám

RECEPTIONIST không có quyền:

- Xóa bệnh nhân
- Tạo hoặc sửa phiếu khám
- Tạo hoặc sửa đơn thuốc
- Quản lý thuốc
- Quản lý hóa đơn
- Quản lý thanh toán

### DOCTOR

DOCTOR có quyền:

- Xem bệnh nhân
- Xem chi tiết bệnh nhân
- Xem lịch khám
- Xem chi tiết lịch khám
- Xem bác sĩ
- Xem chuyên khoa
- Xem phiếu khám
- Tạo phiếu khám
- Sửa phiếu khám
- Xem thuốc
- Xem đơn thuốc
- Tạo đơn thuốc
- Cập nhật đơn thuốc
- Thêm thuốc vào đơn
- Cập nhật thuốc trong đơn
- Xóa thuốc khỏi đơn

DOCTOR không có quyền:

- Quản lý user
- Quản lý role
- Quản lý hóa đơn
- Tạo hoặc sửa thanh toán

### PHARMACIST

PHARMACIST có quyền:

- Xem thuốc
- Tạo thuốc
- Xem chi tiết thuốc
- Cập nhật thuốc
- Xóa thuốc
- Điều chỉnh tồn kho
- Xem đơn thuốc
- Xem chi tiết đơn thuốc

PHARMACIST không có quyền:

- Sửa đơn thuốc
- Quản lý bệnh nhân
- Quản lý lịch khám
- Quản lý phiếu khám
- Quản lý hóa đơn
- Quản lý thanh toán

### CASHIER

CASHIER có quyền:

- Xem bệnh nhân
- Xem chi tiết bệnh nhân
- Xem lịch khám
- Xem chi tiết lịch khám
- Xem phiếu khám
- Xem chi tiết phiếu khám
- Xem hóa đơn
- Tạo hóa đơn
- Xem chi tiết hóa đơn
- Cập nhật hóa đơn
- Cập nhật trạng thái hóa đơn
- Xem thanh toán
- Tạo thanh toán
- Capture thanh toán

CASHIER không có quyền:

- Quản lý user
- Quản lý role
- Quản lý bác sĩ
- Quản lý thuốc
- Quản lý đơn thuốc

## 13. Tài khoản ADMIN mặc định

Sau khi chạy:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

Hệ thống sẽ tự động tạo tài khoản ADMIN đầu tiên.

Thông tin đăng nhập:

```text
Email: admin@clinic.test
Password: Admin@123456
Role: ADMIN
```

Password được hash trước khi lưu vào database.

Tài khoản ADMIN có toàn bộ permission của hệ thống và có thể sử dụng để đăng nhập ngay sau khi seed database thành công.

## 14. Kiểm tra Database

Kết nối vào PostgreSQL container:

```bash
docker compose exec db psql -U clinic -d clinic
```

Xem danh sách các bảng:

```sql
\dt
```

Kiểm tra roles:

```sql
SELECT * FROM roles;
```

Kiểm tra permissions:

```sql
SELECT * FROM permissions;
```

Kiểm tra role permissions:

```sql
SELECT * FROM role_permissions;
```

Kiểm tra tài khoản ADMIN:

```sql
SELECT id, name, email, role_id
FROM users
WHERE email = 'admin@clinic.test';
```

Đếm số lượng permission:

```sql
SELECT COUNT(*) FROM permissions;
```

## 15. Các Task đã hoàn thành

### T1.1 - Docker Engine và Docker Compose

- Cài đặt và kiểm tra Docker Engine trên Ubuntu 24.
- Cài đặt Docker Compose Plugin.
- Tạo project Laravel.
- Kiểm tra môi trường Docker hoạt động.

### T1.2 - Dockerfile và Docker Compose

- Tạo Dockerfile cho Laravel application.
- Tạo `docker-compose.yml`.
- Tạo service `app`.
- Tạo service `db` sử dụng PostgreSQL 16.
- Persist database bằng Docker volume.
- Map port API `8000`.
- Project có thể chạy bằng:

```bash
docker compose up -d --build
```

### T1.3 - Environment Configuration

- Cấu hình `DB_CONNECTION=pgsql`.
- Cấu hình `DB_HOST=db`.
- Cấu hình `EXAMINATION_FEE`.
- Cấu hình PayPal Sandbox.
- Thêm PayPal Client ID/Secret placeholder.
- Cấu hình PayPal Currency.
- Không commit `.env` và secret lên GitHub.

### T1.4 - PostgreSQL Connection

- Kết nối Laravel với PostgreSQL trong Docker.
- Sử dụng Docker service `db` làm database host.
- Cấu hình PostgreSQL cho Laravel.
- Chạy migration thành công trong Laravel container.

### T1.5 - RBAC Catalog

Tạo các bảng:

```text
roles
permissions
role_permissions
```

Các ràng buộc:

```text
permissions.name UNIQUE
role_permissions UNIQUE(role_id, permission_id)
```

Không sử dụng Spatie Permission.

### T1.7 - User Role

- Thêm `users.role_id`.
- Tạo foreign key tới `roles.id`.
- Mỗi user có một role.
- Seed các role:

```text
ADMIN
RECEPTIONIST
DOCTOR
PHARMACIST
CASHIER
```

Mỗi role có `display_name`.

### T1.8 - Permissions và Role Permissions

- Seed đầy đủ permission theo catalog RBAC.
- Permission sử dụng format `CONTROLLER.ACTION`.
- Seed bảng `role_permissions`.
- Map permission theo từng role.
- Đảm bảo permission được phân quyền đúng theo đề bài.
- Không thêm permission cho các action không sử dụng RBAC user.

### T1.9 - Initial ADMIN Account

- Tạo tài khoản ADMIN đầu tiên.
- Email:

```text
admin@clinic.test
```

- Gán role `ADMIN`.
- Password được hash trước khi lưu database.
- Có thể login ngay sau khi chạy:

```bash
docker compose exec app php artisan migrate:fresh --seed
```


## 16. Useful Commands

Khởi động project:

```bash
docker compose up -d
```

Build lại container:

```bash
docker compose up -d --build
```

Xem trạng thái container:

```bash
docker compose ps
```

Xem log của Laravel application:

```bash
docker compose logs -f app
```

Xem log PostgreSQL:

```bash
docker compose logs -f db
```

Vào Laravel container:

```bash
docker compose exec app bash
```

Chạy migration:

```bash
docker compose exec app php artisan migrate
```

Chạy seeder:

```bash
docker compose exec app php artisan db:seed
```

Reset database và chạy lại toàn bộ migration + seeder:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

Vào PostgreSQL:

```bash
docker compose exec db psql -U clinic -d clinic
```

Dừng container:

```bash
docker compose down
```

Dừng container và xóa volume database:

```bash
docker compose down -v
```
