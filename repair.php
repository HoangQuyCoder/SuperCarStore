<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();
// Fetch products with discount = 1
$discounted_products = [];
$stmt = $conn->prepare("SELECT products_id, title, price, images FROM products WHERE discount = ? LIMIT 3");
if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
}

$discount = 1; // Set discount value
$stmt->bind_param("i", $discount);
$stmt->execute();
$result = $stmt->get_result();

$discounted_products = [];
while ($row = $result->fetch_assoc()) {
        $discounted_products[] = $row;
}

$stmt->close();
$conn->close();
?>

<style>
        .repair-container {
                padding: 100px 0;
        }

        .col-sm-9 {
                flex: 0 0 75%;
                max-width: 75%;
        }

        .col-sm-3 {
                flex: 0 0 25%;
                max-width: 25%;
        }
</style>

<?php include("navbar.php"); ?>

<div class="repair-container">
        <div class="row">
                <div class="col-sm-9 col-12" style="padding-right: 15px;">
                        <h1 class="page_title mt-2 mb-2">Sửa chữa</h1>
                        <h6 class="detail-new-teaser text-justify"> <strong>Dịch vụ cơ bản sửa chữa ô tô và một số lưu ý khi sử dụng và sửa chữa ô tô tại SAC
                                </strong> </h6>
                        <p></p>
                        <p><span style="color: rgb(64, 64, 64); font-size: 14px;">Chúng ta đang sống trong thời đại công nghệ số không ngừng phát triển mạnh mẽ với những sản phẩm công nghệ rất đa dạng.
                                        Trong số đó, ô tô là một trong những sản phẩm ngày càng trở nên gần gũi, gắn bó với nhu cầu cuộc sống hàng ngày.
                                        Hầu hết trong số chúng ta đều mong muốn sở hữu một chiếc ô tô "xịn sò" và có độ bền bỉ cao.
                                        Tuy nhiên, trong quá trình sử dụng, sẽ rất khó tránh khỏi những trường hợp hỏng hóc do lỗi sản xuất không thể tránh khỏi, do bảo quản không đúng cách, do tai nạn ngoài ý muốn.</span></p>
                        <div class="f-news-view-detail"
                                style="box-sizing: border-box; color: rgb(64, 64, 64); font-size: 13px; line-height: 21px;">
                                <p
                                        style="box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; text-align: center;">
                                        <span style="box-sizing: border-box; font-size: 14px;"><img alt=""
                                                        src="./uploads/img/otodien/tesla_model_y/tesla_model_y.jpg"
                                                        style="box-sizing: border-box; border: none; vertical-align: middle; margin: 0px; padding: 0px;"
                                                        width="500" height="334"></span>
                                </p>
                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                <h2>Lưu ý khi sử dụng ô tô:</h2>

                                        </span>
                                <ul>
                                        <li><b>Bảo dưỡng xe định kỳ:</b> Đưa xe đi bảo dưỡng đúng hẹn để phát hiện và xử lý sớm các vấn đề tiềm ẩn.</li>
                                        <li><b>Kiểm tra xe thường xuyên:</b> Kiểm tra lốp, dầu nhớt, nước làm mát, phanh,... trước mỗi chuyến đi dài.</li>
                                        <li><b>Lái xe cẩn thận:</b> Tuân thủ luật giao thông, tránh các hành vi lái xe nguy hiểm.</li>
                                        <li><b>Đỗ xe đúng cách:</b> Chọn nơi đỗ xe an toàn, tránh để xe ở nơi có nhiệt độ quá cao hoặc quá ẩm ướt.</li>
                                </ul>
                                </p>
                                <br>
                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                <h2>Một số dịch vụ cơ bản sửa chữa, thay thế tại SAC:</h2>
                                        </span>
                                <ul>
                                        <li><b>Bảo dưỡng định kỳ:</b> Thay dầu nhớt, lọc dầu, lọc gió, kiểm tra hệ thống phanh, lốp xe, ắc quy, nước làm mát,...</li>
                                        <li><b>Sửa chữa động cơ:</b> Khắc phục các lỗi liên quan đến động cơ như hư hỏng piston, xilanh, trục khuỷu, cam, van,...</li>
                                        <li><b>Sửa chữa hộp số:</b> Khắc phục các lỗi liên quan đến hộp số như hư hỏng bánh răng, ly hợp, biến mô,...</li>
                                        <li><b>Sửa chữa hệ thống phanh:</b> Thay thế má phanh, đĩa phanh, bơm phanh, kiểm tra và điều chỉnh hệ thống ABS,...</li>
                                        <li><b>Sửa chữa hệ thống lái:</b> Thay thế rotuyn lái, thước lái, bơm trợ lực lái, kiểm tra và cân chỉnh độ chụm,...</li>
                                        <li><b>Sửa chữa hệ thống treo:</b> Thay thế giảm xóc, lò xo, rotuyn cân bằng,...</li>
                                        <li><b>Sửa chữa điện thân xe:</b> Khắc phục các lỗi liên quan đến hệ thống điện như đèn, còi, gạt mưa, khóa cửa, điều hòa,...</li>
                                        <li><b>Sửa chữa điều hòa:</b> Kiểm tra và nạp gas điều hòa, thay thế lọc gió điều hòa, sửa chữa các lỗi liên quan đến hệ thống điều hòa,...</li>
                                        <li><b>Thay thế phụ tùng:</b> Cung cấp và thay thế các loại phụ tùng ô tô chính hãng hoặc tương đương.</li>
                                        <li><b>Sơn và gò hàn:</b> Phục hồi và làm mới lớp sơn xe, gò hàn các vết móp méo do va chạm.</li>
                                        <li><b>Vệ sinh và chăm sóc xe:</b> Rửa xe, vệ sinh nội thất, đánh bóng xe, phủ ceramic,...</li>
                                        <li><b>Cứu hộ giao thông:</b> Hỗ trợ cứu hộ xe gặp sự cố trên đường.</li>
                                </ul>
                                </p>
                                <br>
                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                <h2>Tại sao nên chọn SAC?</h2>
                                        </span>

                                <ul>
                                        <li><b>Đội ngũ kỹ thuật viên chuyên nghiệp:</b> Được đào tạo chuyên sâu, có kinh nghiệm lâu năm trong ngành.</li>
                                        <li><b>Quy trình sửa chữa chuyên nghiệp:</b> Nhận và sửa máy khoa học, thông tin khách hàng được lưu giữ cẩn thận.</li>
                                        <li><b>Linh kiện chính hãng:</b> Cam kết sử dụng linh kiện, phụ kiện chính hãng, chất lượng tốt nhất.</li>
                                        <li><b>Thời gian sửa chữa nhanh chóng:</b> Sửa chữa tại chỗ, khách hàng có thể quan sát trực tiếp.</li>
                                        <li><b>Giá cả hợp lý:</b> Đảm bảo giá dịch vụ tốt nhất thị trường.</li>
                                        <li><b>Bảo hành dài hạn:</b> Tất cả các máy ảnh, máy quay phim... được sửa chữa đều được bảo hành từ 3 tháng đến một năm.</li>
                                        <li><b>Hỗ trợ khách hàng tận tình:</b> Tư vấn, hỗ trợ miễn phí, có chế độ mượn máy cho khách hàng trong thời gian sửa chữa.</li>
                                </ul>
                                </p>

                                <br>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                        style="box-sizing: border-box; font-weight: bolder;">SAC
                                                        khẳng định luôn
                                                        trung
                                                        thực, thông báo đúng tình trạng và những hư hỏng của
                                                        máy, báo giá đầy
                                                        đủ dịch
                                                        vụ sửa chữa</span>. Đồng thời, <span
                                                        style="box-sizing: border-box; font-weight: bolder;">cung
                                                        cấp hóa đơn sửa chữa, thay
                                                        thế</span> (nếu cần).</span></p>
                                <p class="f-new-view-detail-content"> </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Bảo dưỡng định kỳ: Thay dầu nhớt, lọc dầu, lọc gió, kiểm tra hệ thống phanh, lốp xe, ắc quy, nước làm mát,...
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Sửa chữa động cơ: Khắc phục các lỗi liên quan đến động cơ như hư hỏng piston, xilanh, trục khuỷu, cam, van,...
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Sửa chữa hộp số: Khắc phục các lỗi liên quan đến hộp số như hư hỏng bánh răng, ly hợp, biến mô,...
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Sửa chữa hệ thống phanh: Thay thế má phanh, đĩa phanh, bơm phanh, kiểm tra và điều chỉnh hệ thống ABS,...
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Sửa chữa hệ thống lái: Thay thế rotuyn lái, thước lái, bơm trợ lực lái, kiểm tra và cân chỉnh độ chụm,...
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Sửa chữa hệ thống treo: Thay thế giảm xóc, lò xo, rotuyn cân bằng,...
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Sửa chữa điện thân xe: Khắc phục các lỗi liên quan đến hệ thống điện như đèn, còi, gạt mưa, khóa cửa, điều hòa,...
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Sửa chữa điều hòa: Kiểm tra và nạp gas điều hòa, thay thế lọc gió điều hòa, sửa chữa các lỗi liên quan đến hệ thống điều hòa,...
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Thay thế phụ tùng: Cung cấp và thay thế các loại phụ tùng ô tô chính hãng hoặc tương đương.
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Sơn và gò hàn: Phục hồi và làm mới lớp sơn xe, gò hàn các vết móp méo do va chạm.
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Vệ sinh và chăm sóc xe: Rửa xe, vệ sinh nội thất, đánh bóng xe, phủ ceramic,...
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Cứu hộ giao thông: Hỗ trợ cứu hộ xe gặp sự cố trên đường.
                                        </span>
                                </p>

                                <div
                                        style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 252, 252); text-align: center;">
                                        <span style="box-sizing: border-box; font-size: 14px;"><img alt=""
                                                        src="./uploads/img/banner1.jpg"
                                                        style="box-sizing: border-box; border: none; vertical-align: middle; height: 200px; margin: 0px; padding: 0px; width: 524px;"></span>
                                </div>
                                <div
                                        style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 252, 252);">
                                        <p class="f-new-view-detail-content">
                                        </p>
                                </div>
                                <p class="f-new-view-detail-content"><span
                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                        style="box-sizing: border-box; font-weight: bolder;">Một
                                                        số lưu ý khi sử dụng
                                                        và sửa ô tô</span></span></p>
                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Ô tô là một tài sản có giá trị và cần được bảo dưỡng đúng cách để đảm bảo hoạt động tốt và kéo dài tuổi thọ. Việc sử dụng và bảo quản không đúng cách có thể dẫn đến hư hỏng và tốn kém chi phí sửa chữa.
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Khí hậu Việt Nam có thể gây ảnh hưởng đến các bộ phận của ô tô. Cần chú ý bảo vệ xe khỏi tác động của thời tiết như nắng, mưa, ẩm ướt.
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Việc lựa chọn địa điểm sửa chữa ô tô uy tín là rất quan trọng. Cần tìm hiểu kỹ về các trung tâm bảo hành, gara ô tô để đảm bảo chất lượng dịch vụ và tránh bị "luộc đồ", "om máy".
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Giá cả sửa chữa, thời gian sửa chữa và linh kiện thay thế có thể khác nhau tùy thuộc vào từng địa điểm. Nên tham khảo giá ở nhiều nơi và thỏa thuận rõ ràng trước khi quyết định sửa chữa.
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Khi mang xe đi sửa chữa, cần yêu cầu cửa hàng xác nhận tình trạng xe trước khi sửa chữa, ký tên vào các bộ phận linh kiện bên trong nếu cần thiết.
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Cần có thỏa thuận bảo hành sau sửa chữa để đảm bảo quyền lợi của khách hàng.
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Nên đến những địa chỉ sửa chữa, bảo hành chính hãng để được đảm bảo về quy trình sửa chữa chuyên nghiệp và chất lượng.
                                        </span>
                                </p>

                                <p class="f-new-view-detail-content">
                                        <span style="box-sizing: border-box; font-size: 14px;">
                                                - Nếu xe gặp phải hư hỏng nặng, chi phí sửa chữa lớn, nên cân nhắc việc mua xe mới thay vì tiếp tục sửa chữa.
                                        </span>
                                </p>
                                <div
                                        style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 252, 252);">
                                        <p class="f-new-view-detail-content">
                                                <span style="box-sizing: border-box; font-size: 14px;"><span
                                                                style="box-sizing: border-box; font-family: tahoma, geneva, sans-serif;"><span
                                                                        style="box-sizing: border-box; font-weight: bolder;">Trung
                                                                        Tâm Bảo Hành -
                                                                        Sửa Chữa Ô TÔ
                                                                        SAC</span></span></span>
                                        </p>
                                        <div class="bg_white relative"
                                                style="box-sizing: border-box; margin: 0px; padding: 0px; position: relative; line-height: 18.6px;">
                                                <div class="bg_lienhe"
                                                        style="box-sizing: border-box; margin: 0px; padding: 15px;">
                                                        <div
                                                                style="box-sizing: border-box; margin: 0px; padding: 0px;">
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);"><span
                                                                                                style="box-sizing: border-box; font-weight: bolder;"><img
                                                                                                        alt=""
                                                                                                        src="./uploads/img/Fureture.jpg"
                                                                                                        style="box-sizing: border-box; border: none; vertical-align: middle; float: left; width: 150px;height: 90px; margin: 30px 15px; padding: 0px; ">
                                                                                                SAC -
                                                                                                Prfessional
                                                                                                CAR &amp;
                                                                                                Accessories</span></span></span>
                                                                </p>
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);"><span
                                                                                                style="box-sizing: border-box; font-weight: bolder;">
                                                                                        </span>Công Ty TNHH
                                                                                        SAC (SACMA Co.,
                                                                                        Ltd)
                                                                                </span></span>
                                                                </p>
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);">
                                                                                        70 Tô ký, Quận
                                                                                        12, TP.HCM</span></span>
                                                                </p>
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);">
                                                                                        Điện
                                                                                        thoại<span
                                                                                                style="box-sizing: border-box; color: rgb(64, 64, 64);">:
                                                                                                999 999 999 -
                                                                                                Hotline: 999 999 999 - 999 999 999</span></span></span>
                                                                </p>
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);">
                                                                                        <span
                                                                                                style="box-sizing: border-box; color: rgb(64, 64, 64);">Phòng
                                                                                                Kỹ
                                                                                                Thuật &amp; Sửa
                                                                                                chữa: 999 999 999</span></span></span>
                                                                </p>
                                                                <p class="f-new-view-detail-content">
                                                                        <span
                                                                                style="box-sizing: border-box; font-size: 14px;"><span
                                                                                        style="box-sizing: border-box; color: rgb(0, 0, 0);">
                                                                                        Email: sac@gmail.com
                                                                                        - Website:
                                                                                        www.sac.vn</span></span>
                                                                </p>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>

                </div>
                <div class="col-sm-3 col-12">
                        <div class="block-product-item">
                                <h3 class="page_title text-center">Sản phẩm nổi bật</h3>
                                <?php if (!empty($discounted_products)): ?>
                                        <?php foreach ($discounted_products as $product): ?>
                                                <div class="item"> <a href="product.php?id=<?php echo $product['products_id']; ?>" style="text-decoration: none;">
                                                </div>
                                                <div class="content" style=" background-color: burlywood;">
                                                        <div class="img" style="text-align: center; color: black; ">
                                                                <img src="./uploads/<?php echo $product['images'] ?>" alt="<?php echo htmlspecialchars($product['title']); ?>"
                                                                        class="img-responsive " style="width: 100%;  ">
                                                                <label class="productPrice" style="font-style:bole; font-size:30px"><?php echo htmlspecialchars($product['title']); ?></label>
                                                                <p class="productPrice" style="font-size:20px">Giá từ: <strong><?php echo number_format($product['price'], 0, ',', '.'); ?>đ </strong> </p>
                                                        </div>
                                                        </a>
                                                </div>
                                        <?php endforeach; ?>
                                <?php else: ?>
                                        <p>Không có sản phẩm nào có giảm giá.</p>
                                <?php endif; ?>
                        </div>
                </div>
        </div>


        <!-- footer  -->
        <?php include("footer.php"); ?>