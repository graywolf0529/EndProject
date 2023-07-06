<!DOCTYPE html>
<!-- 11200149295005 -->
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body id="ToDoListBody">
    <?php include("header.php")?>
    
    <header  id="ToDoListHeader">
        <h1>To Do List</h1>
    </header>
    <div class="container">
        <form>
            <div class="row">
                <div class="col-md-4 col-sm-12 text-md-end text-sm-center mt-1">
                    <input type="text" name="T" id="T" placeholder="待辦事項" class="form-control">
                </div>
                <div class="col-md-4 col-sm-12 text-center mt-1">
                    <input type="number" min="2021" max="2050" placeholder="Y" required name="Y" id="Y"
                        class="form-control">
                    <input type="number" min="1" max="12" placeholder="M" required name="M" id="M" class="form-control">
                    <input type="number" min="1" max="31" placeholder="D" required name="D" id="D" class="form-control">
                </div>
                <div class="col-md-4 col-sm-12 text-md-start text-center mt-1">
                    <button type="submit" class="btn btn-lg btn-success">Add into List</button>
                </div>
            </div>
        </form>
    </div>

    <div class="sort">
        <button class="btn btn-lg btn-success">依預定時間排序</button>
    </div>


    <section id="ToDoListSection">
        <input type="hidden" class="">
    </section>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="../js/time.js"></script>
    <script>
        let add = document.querySelector("form button");
        let section = document.querySelector("section#ToDoListSection");
        let keyList = "abcdefghijklmnopqrstuvwxyz1234567890";
        add.addEventListener("click", e => {
            e.preventDefault();
            let form = e.target.parentElement;
            let todoText = $("#T").val();
            let todoYear = $("#Y").val();
            let todoMonth = $("#M").val();
            let todoDate = $("#D").val();

            if (todoText === "") {
                alert("請輸入事項");
                return;
            }else if (todoYear === "" || todoMonth === "" || todoDate === ""){
                alert("請輸入時間");
                return;
            }

            let todo = document.createElement("div");
            todo.classList.add("todo");
            let text = document.createElement("p");
            text.classList.add("todo-text");
            text.innerText = todoText;
            let time = document.createElement("p");
            time.classList.add("todo-time");
            time.innerText = todoYear + "/" + todoMonth + "/" + todoDate;
            todo.appendChild(text)
            todo.appendChild(time);

            let sn = document.createElement("input");
            sn.type = "hidden";
            let sn_value = "";
            for (i = 0; i < 10; i++) {
                let k_n = getRandom(36);
                sn_value += keyList.substring((k_n) - 1, k_n);
            }
            sn.value = sn_value;
            todo.appendChild(sn);

            let completeButton = document.createElement("button");
            completeButton.classList.add("complete");
            completeButton.innerHTML = '<i class="fa-regular fa-circle-check"></i>';
            completeButton.addEventListener("click", e => {
                let todoItem = e.target.parentElement;
                todoItem.classList.add("done");
            });

            let trashButton = document.createElement("button");
            trashButton.classList.add("trash");
            trashButton.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
            trashButton.addEventListener("click", e => {
                let todoItem = e.target.parentElement;
                todoItem.addEventListener("animationend", () => {
                    let text = todoItem.children[0].innerText;
                    let sn = todoItem.children[2].value;
                    let myListArray = JSON.parse(localStorage.getItem("list"));
                    myListArray.forEach((item, index) => {
                        if (item.sn == sn) {
                            myListArray.splice(index, 1);
                            localStorage.setItem("list", JSON.stringify(myListArray));
                        }
                    })
                    todoItem.remove();
                })
                todoItem.style.animation = "scaleDown 0.3s forwards";
            });

            todo.appendChild(completeButton);
            todo.appendChild(trashButton);
            todo.style.animation = "scaleUp 0.3s forwards";

            section.appendChild(todo);
            $("#T").val("");

            let myTodo = {
                todoText: todoText,
                todoYear: todoYear,
                todoMonth: todoMonth,
                todoDate: todoDate,
                sn: sn_value
            };

            let myList = localStorage.getItem("list");
            if (myList == null) {
                localStorage.setItem("list", JSON.stringify([myTodo]));
            } else {
                let myListArray = JSON.parse(myList);
                myListArray.push(myTodo);
                localStorage.setItem("list", JSON.stringify(myListArray));
            }

            console.log(JSON.parse(localStorage.getItem("list")));
        });

        function getRandom(x) {
            return Math.floor(Math.random() * x) + 1;
        };

        function loadData() {
            let myList = localStorage.getItem("list");
            let NewListArray = [];
            if (myList !== null) {
                let myListArray = JSON.parse(myList);
                myListArray.forEach(item => {
                    let todo = document.createElement("div");
                    todo.classList.add("todo");
                    let text = document.createElement("p");
                    text.classList.add("todo-text");
                    text.innerText = item.todoText;
                    let time = document.createElement("p");
                    time.classList.add("todo-time");
                    time.innerText = item.todoYear + "/" + item.todoMonth + "/" + item.todoDate;
                    todo.appendChild(text);
                    todo.appendChild(time);

                    let sn = document.createElement("input");
                    sn.type = "hidden";
                    let sn_value = "";
                    for (i = 0; i < 10; i++) {
                        let k_n = getRandom(36);
                        sn_value += keyList.substring((k_n) - 1, k_n);
                    }
                    sn.value = sn_value;

                    let myTodo = {
                        todoText: item.todoText,
                        todoYear: item.todoYear,
                        todoMonth: item.todoMonth,
                        todoDate: item.todoDate,
                        sn: sn_value
                    };
                    NewListArray.push(myTodo);

                    todo.appendChild(sn);

                    let completeButton = document.createElement("button");
                    completeButton.classList.add("complete");
                    completeButton.innerHTML = '<i class="fa-regular fa-circle-check"></i>';
                    completeButton.addEventListener("click", e => {
                        let todoItem = e.target.parentElement;
                        todoItem.classList.add("done");
                    });

                    let trashButton = document.createElement("button");
                    trashButton.classList.add("trash");
                    trashButton.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
                    trashButton.addEventListener("click", e => {
                        let todoItem = e.target.parentElement;
                        todoItem.addEventListener("animationend", () => {
                            let text = todoItem.children[0].innerText;
                            let sn = todoItem.children[2].value;
                            let myListArray = JSON.parse(localStorage.getItem("list"));
                            myListArray.forEach((item, index) => {
                                if (item.sn == sn) {
                                    myListArray.splice(index, 1);
                                    localStorage.setItem("list", JSON.stringify(myListArray));
                                }
                            })
                            todoItem.remove();
                        })
                        todoItem.style.animation = "scaleDown 0.3s forwards";
                    });

                    todo.appendChild(completeButton);
                    todo.appendChild(trashButton);
                    todo.style.animation = "scaleUp 0.3s forwards";

                    section.appendChild(todo);
                })
                localStorage.setItem("list", JSON.stringify(NewListArray));
            }
            console.log(JSON.parse(localStorage.getItem("list")));
        }

        loadData();

        function mergeTime(arr1, arr2) {
            let result = [];
            let i = 0;
            let j = 0;
            while (i < arr1.length && j < arr2.length) {
                if (Number(arr1[i].todoYear) > Number(arr2[j].todoYear)) {
                    result.push(arr2[j]);
                    j++
                } else if (Number(arr1[i].todoYear) < Number(arr2[j].todoYear)) {
                    result.push(arr1[i]);
                    i++
                } else if (Number(arr1[i].todoYear) == Number(arr2[j].todoYear)) {
                    if (Number(arr1[i].todoMonth) > Number(arr2[j].todoMonth)) {
                        result.push(arr2[j]);
                        j++
                    } else if (Number(arr1[i].todoMonth) < Number(arr2[j].todoMonth)) {
                        result.push(arr1[i]);
                        i++
                    } else if (Number(arr1[i].todoMonth) == Number(arr2[j].todoMonth)) {
                        if (Number(arr1[i].todoDate) > Number(arr2[j].todoDate)) {
                            result.push(arr2[j]);
                            j++
                        } else {
                            result.push(arr1[i]);
                            i++
                        }
                    }
                }
            }
            while (i < arr1.length) {
                result.push(arr1[i]);
                i++
            }
            while (j < arr2.length) {
                result.push(arr2[j]);
                j++
            }
            return result;
        }
        function mergeSort(arr) {
            if (arr.length === 1) {
                return arr;
            } else {
                let middle = Math.floor(arr.length / 2);
                let right = arr.slice(0, middle);
                let left = arr.slice(middle, arr.length);
                return mergeTime(mergeSort(right), mergeSort(left));
            }
        }

        let sortButton = document.querySelector("div.sort button");
        sortButton.addEventListener("click", () => {
            let sortedArray = mergeSort(JSON.parse(localStorage.getItem("list")));
            localStorage.setItem("list", JSON.stringify(sortedArray));

            let len = section.children.length;
            for (let i = 0; i < len; i++) {
                section.children[0].remove();
            }

            loadData();
        })
    </script>
</body>

</html>