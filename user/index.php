<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Ordering</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-3">Manage User</h1>
        <hr>
        <?php
        if (isset($_GET['err'])) {
            echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
            echo "<strong>Error: </strong>" . $_GET['err'];
            echo "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>";
            echo "</div>";
        }
        ?>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Thêm người dùng mới</button>
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="add.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <input class="form-control my-2" type="text" placeholder="Tên đăng nhập" name="tenDangNhap" />
                            </div>
                            <div class="form-group">
                                <label>Tên khách hàng</label>
                                <input class="form-control my-2" type="text" placeholder="Tên khách hàng" name="tenKhachHang" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control my-2" placeholder="Địa chỉ" name="diaChi" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control my-2" type="number" placeholder="Số điện thoại" name="sdt" />
                            </div>
                            <div class="mb-3">
                                <label>Ảnh đại diện</label>
                                <input type="file" class="form-control my-2" name="fileToUpload" id="fileToUpload" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng lại</button>
                            <button class="btn btn-primary" type="submit">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped mt-2">
            <thead>
                <tr>
                    <th scope="col">Tên đăng nhập</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Ảnh đại diện</th>
                    <th scope="col">Điểm tích lũy</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once('db_connnection.php');

                $conn = OpenCon();
                $query = "SELECT * FROM `khach_hang`;";

                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    // OUTPUT DATA OF EACH ROW
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr class="justify-content-center">
                            <th class='align-middle' scope="row"><?php echo $row['tenDangNhap'] ?></th>
                            <td class='align-middle'><?php echo $row['tenKhachHang'] ?></td>
                            <td class='align-middle'><?php echo $row['diaChi'] ?></td>
                            <td class='align-middle'><?php echo $row['sdt'] ?></td>
                            <td><img src='<?php echo $row['anhDaiDien'] ?>' class='border rounded-circle p-1' width='72' height='72'></td>
                            <td class='align-middle'><?php echo $row['diemTichLuy'] ?></td>
                            <td class='align-middle'>
                                <div class="d-inline-flex">
                                    <button class="btn btn-secondary m-1">Read</button>
                                    <button type='button' class='btn-edit btn btn-primary m-1' data-bs-tenDangNhap='<?php echo $row['tenDangNhap'] ?>' data-bs-tenKhachHang='<?php echo $row['tenKhachHang'] ?>' data-bs-diaChi='<?php echo $row['diaChi'] ?>' data-bs-sdt='<?php echo $row['sdt'] ?>' data-bs-anhDaiDien='<?php echo $row['anhDaiDien'] ?>' data-bs-diemTichLuy='<?php echo $row['diemTichLuy'] ?>' data-bs-target='#Edit' data-bs-toggle='modal'>Edit</button>
                                    <button type='button' class='btn-delete btn btn-danger m-1' data-bs-tenDangNhap='<?php echo $row['tenDangNhap'] ?>' data-bs-target='#Delete' data-bs-toggle='modal'>Delete</button>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
        <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="Edit" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chỉnh sửa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <input class="form-control my-2" type="text" placeholder="Tên đăng nhập" name="tenDangNhap" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Tên khách hàng</label>
                                <input class="form-control my-2" type="text" placeholder="Tên khách hàng" name="tenKhachHang" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control my-2" placeholder="Địa chỉ" name="diaChi" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control my-2" type="number" placeholder="Số điện thoại" name="sdt" />
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh hiện tại </label>
                                <input class="form-control my-2" type="text" name="anhDaiDien" readonly />
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh mới</label>
                                <input type="file" name="fileToUpload1" id="fileToUpload1" class="form-control my-2" />
                            </div>
                            <div class="form-group">
                                <label>Điểm tích lũy</label>
                                <input class="form-control my-2" type="number" placeholder="Điểm tích lũy" name="diemTichLuy" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Đóng lại</button>
                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="delete.php" method="post">
                        <div class="modal-body">
                            <input type="text" name="tenDangNhap" class="form-control my-2" disabled/>
                            <p>Bạn chắc chưa ?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-outline-light" type="button" data-bs-dismiss="modal">Đóng lại</button>
                            <button class="btn btn-danger btn-outline-light" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="index.js"></script>
</body>

</html>