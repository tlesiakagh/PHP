$(document).ready(function () {
    //-------------------------------SKRYPT DOTYCZĄCY CAŁOŚCI--------------------------------

    // Menu 

    $('#outer li').hover(
        function () {
            $(this).css("background-color", "rgb(0,105,60)")
        },
        function () {
            $(this).css("background-color", "#7c0808")
        },
    )

    // Dane do promocji
    var titles = ["KARTA DUŻEJ RODZINY", "PIĄTKOWE SZALEŃSTWO", "KINO Z RODZINĄ", "OFERTA DLA FIRM"]
    var descriptions = ["Za okazaniem Karty Dużej Rodziny zniżki dla wszystkich jej członków wg cennika", "W każdy pierwszy piątek miesiąca każdy bilet jest tańszy! Przekonaj się sam!", "Można nabyć bilet rodzinny przy zakupie trzech lub więcej biletów na ten sam seans", "Można nabyć bilet grupowy przy zakupie co najmniej 10 biletów na ten sam seans"]
    var images = ["../../img/rodzina.jpg", "../../img/bilety.jpg", "../../img/kinorodzina.jpg", "../../img/kinofirma.jpg"]
    var colors = ["#019290", "#d87e08", "#da2047", "#d843cf"]

    // Tytuły promocji
    titles.forEach(element => {
        $('#promocje').append("<a href=#>" + element + "</a>")
    });

    // Kolory dla promocji
    var offers = document.getElementById("promocje");
    for (let i = 0; i < offers.children.length; i++) {
        offers.children[i].style.backgroundColor = colors[i];
    }

    // Wysuwanie bocznego panelu z promocjami
    $('#trigger').hover(
        function () {
            if ($(this).parent().css("right") == "-360px") {
                $(this).parent().animate({
                    "right": "0"
                }, 500)
            }
            if ($(this).parent().css("right") == "0px") {
                $(this).parent().animate({
                    "right": "-360"
                }, 500)
            }
        }
    )

    // Oznaczenie wybranej promocji
    $('#promocje a').hover(
        function () {
            $(this).css("font-weight", "bold")
        },
        function () {
            $(this).css("font-weight", "normal")
        },
    )

    // Powiększenie promocji
    function destroySelf() {
        $('#popup').remove()
    };

    $('#promocje a').click(function () {
        let kurtyna = $('body');

        let index = $(this).index()
        let title = titles[index]
        let description = descriptions[index]
        let image = images[index]

        $('#popup').remove()
        kurtyna.append("<div id=popup><img src=" + image + " alt=promka><h1>" + title + "</h1><p>" + description + "</p></div>")
        $('#popup').click(function () {
            $('#popup').remove()
        })
    })


    // Powrót z powiększonej promocji
    $('#kurtyna').click(function () {
        $(this).hide();
    })

    //---------------------------------SKRYPT REPETUAR----------------------------

    // Daty dla których przygotowany jest rozkład
    let choosenDateText = "Repertuar na dzień "

    let todayAsClass = new Date();
    var dateAsString = todayAsClass.getDate() + ".0" + (todayAsClass.getMonth() + 1);

    // Ustawienia daty dzisiejszej jako domyślnej
    $('#wybranaData').append(choosenDateText + dateAsString)

    for (let i = 1; i <= 7; i++) {
        let dateDiv = document.createElement("DIV");
        if (i == 1)
            dateDiv.setAttribute("class", "data clicked");
        else
            dateDiv.setAttribute("class", "data");
        dateDiv.innerText = dateAsString
        document.getElementById("daty").appendChild(dateDiv)
        let nextWeek = new Date(todayAsClass.getFullYear(), todayAsClass.getMonth(), todayAsClass.getDate() + i);
        dateAsString = nextWeek.getDate() + ".0" + (nextWeek.getMonth() + 1);
    }

    // Wybór dnia i wyświetlenie godzin filmów dla danego dnia
    var hours = [" 10:20 ", " 12:40 ", " 14:50 ", " 16:30 ", " 18:20 ", " 19:50 ", " 20:10 ", " 22:40 ", " 23:30"]

    $('#daty>div').click(function () {
        if (!$(this).hasClass("clicked")) {
            // Wybór dnia
            $('#wybranaData').text(" ")
            $('#wybranaData').text(choosenDateText + $(this).text())

            // Wyświetlanie godzin dla wybranego dnia
            $('.film p:last-of-type').each(function () {
                let usedIndexes = [];

                for (let i = 0; i < 3; i++) {
                    let index = Math.floor(Math.random() * hours.length);
                    if (usedIndexes.length == 0) {
                        usedIndexes.push(index);
                    } else {
                        if (!usedIndexes.includes(index)) {
                            usedIndexes.push(index);
                        }
                    }
                }
                usedIndexes.sort();

                $(this).text("");
                for (let i = 0; i < usedIndexes.length; i++) {
                    $(this).append(hours[usedIndexes[i]]);
                }
            })

            $('#daty div.clicked').removeClass("clicked")
            $(this).addClass("clicked")
        }
    })
});