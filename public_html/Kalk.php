<form method="post" name="kalk" action="" class="comment_form">
    <p>*Укажите все данные в калькулятор и нажмите кнопку "Посчитать", чтобы получить стоимость растаможки на <?php echo date("Y")." год" ?></p>
    <div class="mb-5 row form-group">
        <label for="disabledSelect" class="form-label col">На кого оформление:</label>

        <select name="legal_entity" id="legal_entity" class="form-select col">
            <option value="1">Физическое лицо</option>
            <option value="2">Юридическое лицо</option>
        </select>

    </div>
    <div class="mb-5 row form-group">
        <label for="disabledSelect" class="form-label col">Возраст автомобиля:</label>
        <select name="year_auto" id="year_auto" class="form-select col">
            <option value="1">Меньше 3х лет</option>
            <option value="2">От 3х до 5 лет</option>
            <option value="3">От 5 до 7 лет</option>
            <option value="4">Старше 7 лет</option>
        </select>
    </div>

    <div class="mb-5 row form-group">
        <label for="disabledSelect" class="form-label col">На каком топливе:</label>
        <select name="engine_auto" id="engine_auto" class="form-select col">
            <option value="1">На бензине</option>
            <option value="2">На дизеле</option>
            <option value="3">Гибрид</option>
            <option id="electro_car" value="electro_car">На электричестве</option>
        </select>
    </div>
    <div class="mb-5 row form-group">
            <label for="inputPassword6" class="form-label col">Мощность:</label>
            <input name="power_engine" type="text" id="power_engine" class="form-control col" required>
       <select name="engine_power_auto" id="engine_power_auto" class="form-select col">
            <option value="1">Лошадиных сил</option>
            <option value="2">Киловатт</option>
        </select>

    </div>

    <div class="row mb-5 form-group" id="volume">
            <label for="inputPassword6" class="col-form-label col">Объем двигателя:</label>
            <input name="volume_engine"  type="text" id="volume_engine" class="form-control col" aria-describedby="passwordHelpInline">

    </div>

    <div class="mb-3 row form-group">
            <label for="inputPassword6" class="col-form-label col-3">Стоимость:</label>

            <input name="prise" type="text" id="prise" class="form-control col-5" required>
             <select name="prise_format_auto" id="prise_format_auto" class="form-select col-3">
                 <option value="rub">Рублей</option>
                 <option value="money_kurs_usd">Долларов</option>
                 <option value="money_kurs_eur">Евро</option>
                 <option value="money_kurs_blr">Бел.рубль</option>
                 <option value="money_kurs_ukr">Гривна</option>
                 <option value="money_kurs_tenge">Каз.тенге</option>
        </select>

        </div>
    <p class="calculate_paragraph"> <?php //echo "Курс EUR - ".number_format(intval($calculate->money_kurs_eur()))." рубля";
        ?>  </p>
    <p class="calculate_paragraph"> <?php //echo "Курс USD - ".number_format(intval($calculate->money_kurs_usd()))." рубля"; ?> </p>
    <div class="errors_kalk" id="errors"></div>
    <input type="submit" name="kalk-submit" class="submit" id="submit" value="Посчитать">


</form>
<?php
if (!empty($_POST['kalk-submit'])){ ?>
    <div class="col-12 col-lg-12 col-sm-12 col-md-12">
        <h2>ИТОГО: <?php echo number_format(intval($calculate->get_calculate()), 2, ',', ' '). " рублей"; ?></h2>
        <p class="calculate_paragraph">* Стоимость растаможки указанного в калькуляторе авто на <?php echo date("Y")." год" ?></p>

    </div>
    <h2 class="text-center">Полный расчёт стоимости растаможки автомобиля:</h2>
    <div class="row calculate_result">
        <div class="col-3 col-lg-3 col-sm-3 col-md-3">
            <img src="../images/config/dump.png" alt="Стоимость утилизационного сбора">
        </div>
        <div class="col-9 col-lg-9 col-sm-9 col-md-9 text-left">
            <?php echo "Утилизационный сбор: ". number_format($calculate->utilizations_in(), 2, ',', ' ')." рублей"; ?>
        </div>
        <div class="col-3 col-lg-3 col-sm-3 col-md-3">
            <img src="../images/config/barrier.png" alt="Стоимость таможенного оформления">
        </div>
        <div class="col-9 col-lg-9 col-sm-9 col-md-9 text-left">
            <?php echo "Таможенное оформление: ". number_format($calculate->nds_customs(), 2, ',', ' ')." рублей"; ?>
        </div>
        <div class="col-3 col-lg-3 col-sm-3 col-md-3">
            <img src="../images/config/licensing.png" alt="Стоимость акцизного сбора">
        </div>
        <div class="col-9 col-lg-9 col-sm-9 col-md-9 text-left">
            <?php echo "Акцизный сбор: ". number_format(intval($calculate->akciz()), 2, ',', ' ')." рублей"; ?>
        </div>
        <div class="col-3 col-lg-3 col-sm-3 col-md-3">
            <img src="../images/config/money-bag.png" alt="стоимость НДС">
        </div>
        <div class="col-9 col-lg-9 col-sm-9 col-md-9 text-left">
            <?php echo "НДС: ". number_format(intval($calculate->nds()), 2, ',', ' ')." рублей"; ?>
        </div>
        <div class="col-3 col-lg-3 col-sm-3 col-md-3">
            <img src="../images/config/tax.png" alt="Стоимость таможенной пошлины">
        </div>
        <div class="col-9 col-lg-9 col-sm-9 col-md-9 text-left">
            <?php echo "Таможенная пошлина: ". number_format($calculate->customs_nds(), 2, ',', ' '). " рублей";


            ?>
        </div>
    </div>
<?php } ?>
