/* SLIDES DO CARDS NA HOME */

    // $('.quadro-todos-cards').slick({
    //     centerMode: false,
    //     slideToShow: 4,
    //     slidesToScroll: 4,
    //     infinite: false,
    //     prevArrow:"<button type='button' class='btn-left-slider-emAlta espenext slick-prev pull-left'><i class='bx bxs-chevron-left'></i></button>",
    //         nextArrow:"<button type='button' class='btn-right-slider-emAlta espenext slick-next pull-right'><i class='bx bxs-chevron-right'></i></button>",
    //         responsive: [
    //             {
    //               breakpoint: 768,
    //               settings: {
    //                 slidesToShow: 1,
    //                 slidesToScroll: 1,
    //                 infinite: true,
    //                 dots: false
    //               }
    //             },
    //         ]
    //     });

    $('.content-banners-home').slick({
        infinite: true,
        arrows: false,
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
    });
