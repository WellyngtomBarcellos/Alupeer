// resources/js/flatpickr-setup.js
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#check-in-date", {
        dateFormat: "Y-m-d",
        minDate: "today",
        // Habilita a seleção de intervalo de datas
        mode: "range",
        // Configura o texto do botão de limpar
        clearButton: true
    });

    flatpickr("#check-out-date", {
        dateFormat: "Y-m-d",
        minDate: "today",
        // Habilita a seleção de intervalo de datas
        mode: "range",
        // Configura o texto do botão de limpar
        clearButton: true
    });
});
