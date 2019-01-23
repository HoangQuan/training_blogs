## Đây là dự án đầu tiên tôi học Laravel
### Để chạy dự án vui lòng lấy code từ github của tôi như sau:
```
git clone url_git
```

#### Cài đặt các thư viện:
```
cd project_path
composer install

```

#### Chạy server (bước này chỉ cần nếu bạn ko dùng công cụ như Xamp hoặc Laragon)
```
php artisan serve
```

#### Chạy ứng dụng trên trình duyệt tại địa chỉ

http://localhost:8000

#### Nội dung:
- master => Khởi tạo dự án
- layout => Thêm layout cho dự án
- add_load_more => Trang danh sách sản phẩm và loadmore
- add_show_page => Trang chi tiết bài viết
- add_create_post: Trang tạo bài viết cho user
- 01_create_with_ckeditor_plugin : Trang tạo bài viết cho user dùng CKEDITOR
- 02_edit_post_page => Trang sửa bài viết cho user
- 03_view_post => Hiển thị chi viết bài viết
- 04_auth_by_laravel => Đăng nhập sử dụng auth của laravel
- 05_auth_by_custome => Tính năng đăng nhập tự code
- 06_like_in_action => Tính năng Like bài viết
- 07_post_create_by_user => Bài viết cùng tác giả
- 08_user_comment_post => Tính năng comment trên bài viết
- 09_manager_page => Trang quản trị cho admin
