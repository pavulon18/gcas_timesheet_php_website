/* 
 * The MIT License
 *
 * Copyright 2018 Jim Baize <pavulon@hotmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * 
 * Special thanks to: https://github.com/flapjack17 Sean Roche for his invaluable 
 * assistance on making this page work as intended.
 */


const form = document.getElementById('form_1939');
console.log(form);
form.addEventListener('change', formUpdateHandler);

function formUpdateHandler(e) {
    comboCheck(e);
    hideShowLogic(e);
}

function comboCheck(e) {
    const shift = document.querySelector('input[name="is24HrShift"]:checked').value;
    const nightRun = document.querySelector('input[name="isNightRun"]:checked').value;
    const pto = document.querySelector('input[name="isPTO"]:checked').value;

    const nightRuns = Array.from(document.getElementsByName('isNightRun'));

    if (shift === '0') {
        nightRuns.forEach(x => {
            if (x.value === '0')
                x.checked = true;
            x.disabled = true;
        });
    } else {
        nightRuns.forEach(x => x.disabled = false);
    }

    const ptos = Array.from(document.getElementsByName('isPTO'));

    if (shift === '1' && nightRun === '1') {
        ptos.forEach(x => {
            if (x.value === '0')
                x.checked = true;
            x.disabled = true;
        });
    } else {
        ptos.forEach(x => x.disabled = false);
    }

    if (pto === '1') {
        nightRuns.forEach(x => {
            if (x.value === '0')
                x.checked = true;
            x.disabled = true;
        });
    }
}

function hideShowLogic(e) {
    const shift = document.querySelector('input[name="is24HrShift"]:checked').value;
    const nightRun = document.querySelector('input[name="isNightRun"]:checked').value;
    const pto = document.querySelector('input[name="isPTO"]:checked').value;

    const isNightRun = document.getElementById('isNightRun');
    const liReason = document.getElementById('reason');
    const liPto = document.getElementById('isPTO');
    const liWhichPTO = document.getElementById('whichPTO');
    const liStartDate = document.getElementById('startDate');
    const liStartTime = document.getElementById('startTime');
    const liEndTimeBlock = document.getElementById('endTimeBlock');

    if (shift === '1') {
        if (nightRun === '0' && pto === '0')
        {
            isNightRun.style.display = '';// show isNightRun
            liReason.style.display = 'none';// hide reason
            liPto.style.display = '';// show isPTO
            liWhichPTO.style.display = 'none';// hide whichPTO
            liStartDate.style.display = ''; // Show startDate
            liStartTime.style.display = 'none';// hide startTime
            liEndTimeBlock.style.display = 'none';// hide endTimeBlock
        }
        if (nightRun === '1' && pto === '0')
        {
            isNightRun.style.display = '';// show isNightRun
            liReason.style.display = '';// show reason
            liPto.style.display = 'none';// hide isPTO
            liWhichPTO.style.display = 'none';// hide whichPTO
            liStartDate.style.display = ''; // Show startDate
            liStartTime.style.display = '';// hide startTime
            liEndTimeBlock.style.display = '';// hide endTimeBlock
        }
        if (nightRun === '0' && pto === '1')
        {
            isNightRun.style.display = 'none';// hide isNightRun
            liReason.style.display = 'none';// hide reason
            liPto.style.display = '';// show isPTO
            liWhichPTO.style.display = '';// show whichPTO
            liStartDate.style.display = ''; // Show startDate
            liStartTime.style.display = 'none';// hide startTime
            liEndTimeBlock.style.display = 'none';// hide endTimeBlock
        }
    }
    if (shift === '0') {
        if (nightRun === '0' && pto === '0')
        {
            isNightRun.style.display = 'none';// hide isNightRun
            liReason.style.display = '';// show reason
            liPto.style.display = '';// show isPTO
            liWhichPTO.style.display = 'none';// hide whichPTO
            liStartDate.style.display = ''; // Show startDate
            liStartTime.style.display = '';// hide startTime
            liEndTimeBlock.style.display = '';// hide endTimeBlock
        }
        if (nightRun === '0' && pto === '1')
        {
            isNightRun.style.display = 'none';// hide isNightRun
            liReason.style.display = 'none';// hide reason
            liPto.style.display = '';// show isPTO
            liWhichPTO.style.display = '';// show whichPTO
            liStartDate.style.display = ''; // Show startDate
            liStartTime.style.display = '';// hide startTime
            liEndTimeBlock.style.display = '';// hide endTimeBlock
        }
    }
}