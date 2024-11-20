<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #show-modal-btn {
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            position: relative;
            width: 400px;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }
        .input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .modal-content input[type="text"],
        .modal-content input[type="email"],
        .modal-content input[type="tel"],
        .modal-content textarea {
            width: 100%;
            padding: 10px 0;
            border: none;
            border-bottom: 1px solid black;
            background: none;
            font-size: 14px;
            outline: none; 
            transition: border-color 0.3s;
        }

        .modal-content textarea {
            height: 60px;
            resize: none;
        }

        .submit-btn {
            margin-left: 150px;
            margin-top: 10px;
            width: 30%;
            padding: 12px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #444;
        }

    </style>
</head>
<body>
    <button id="show-modal-btn">Gọi lại cho tôi</button>
    <div id="contact-modal" class="modal">
        <div class="modal-content">
            <button class="close-btn">×</button>
            <h2>Gọi lại cho tôi</h2>
            <form>
                <div class="input-group">
                    <input type="text" id="name" placeholder="Họ và tên" required>
                    <input type="email" id="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="tel" id="phone" placeholder="Số điện thoại" required>
                    <input type="text" id="address" placeholder="Địa chỉ">
                </div>
                <input type="text" id="product" placeholder="Sản Phẩm" readonly>
                <textarea id="message" placeholder="Nội dung liên hệ"></textarea>
                <button type="submit" class="submit-btn">Gửi liên hệ</button>
            </form>
        </div>
    </div>
</body>
<script>
    const showModalBtn = document.getElementById("show-modal-btn");
    const modal = document.getElementById("contact-modal");
    const closeModalBtn = document.querySelector(".close-btn");
    showModalBtn.addEventListener("click", () => {
        modal.style.display = "flex";
    });
    closeModalBtn.addEventListener("click", () => {
        modal.style.display = "none";
    });
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
</script>
</html>