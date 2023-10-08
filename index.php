<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>PaySafe</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    </head>
    <body>
       <div class="sidebar">
            <div class="logo"></div>
            <ul class="menu">
                <li class="active">
                    <a href="#" >
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-user"></i>
                        <span>Perfil</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-chart-bar"></i>
                        <span>Estadisticas</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-briefcase"></i>
                        <span>Carreras</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-question-circle"></i>
                        <span>FAQ</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <span>Testimonios</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-cog"></i>
                        <span>Configuracion</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="presentacion.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
       </div> 
       <div class="main--content">
            <div class="header--wrapper">
                <div class="header--title">
                    <span>Primary</span>
                    <h2>Inicio</h2>
                </div>
                <div class="user--info">
                    <div class="search--box">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" placeholder="Buscar">
                    </div>
                    <img src="./images/img.png" alt="">
                </div>
            </div>

            <div class="card-container">
                <h1 class="main--title">Datos de hoy</h1>
                <div class="card--wrapper">
                    <div class="payment--card light-red">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">Cantidad de pago</span>
                                <span class="amount-value">$500.50</span>
                            </div>
                            <i class="fas fa-dollar-sign icon"></i>
                        </div>
                        <span class="card-detail">**** **** **** 5689</span>
                    </div>
                    <div class="payment--card light-purple">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">Deuda Pendiente</span>
                                <span class="amount-value">$8,000.65</span>
                            </div>
                            <i class="fas fa-dollar-sign icon dark-purple"></i>
                        </div>
                        <span class="card-detail">**** **** **** 4786</span>
                    </div>
                </div>
            </div>

            <div class="tabular--wrapper">
                <h3 class="main--title">Datos Financieros</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo De Transaccion</th>
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Categoria</th>
                                <th>Estatus</th>
                                <th>Accion</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2023-09-21</td>
                                <td>Bancaria</td>
                                <td>Cumpleaños del jefe</td>
                                <td>$250</td>
                                <td>Oficina</td>
                                <td>Pendiente</td>
                                <td><button>Editar</button></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">Total: $250</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
       </div>
    </body>
</html>