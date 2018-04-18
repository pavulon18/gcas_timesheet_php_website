<?php
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
 * https://jqueryvalidation.org/
 */


?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Day</th>
                <th>Last Name</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>PTO Day</th>
                <th>Reg Time</th>
                <th>Over Time</th>
                <th>PTO Hours</th>
            </tr>
        </thead>
        <?php foreach ($viewmodel as $item) : ?>
            <tbody>
                <tr>
                    <td><?php echo date('D', strtotime($item['DateTime_In'])); ?></td>
                    <td><?php echo $item['Last_Name']; ?></td>
                    <td><?php echo date('M-d-Y', strtotime($item['DateTime_In'])); ?></td>
                    <td><?php echo date('Hi', strtotime($item['DateTime_In'])); ?></td>
                    <td><?php echo date('Hi', strtotime($item['DateTime_In'])); ?></td>
                <?php
                if ($item['Is_Sick_Day'] == 'Y')
                {
                    echo '<td>Sick Day</td>';
                }
                elseif ($item['Is_Vacation_Day'] == 'Y')
                {
                    echo '<td>Vacation Day</td>';
                }
                elseif ($item['Is_Personal_Day'] == 'Y')
                {
                    echo '<td>Personal Day</td>';
                }
                elseif ($item['Is_Berevement_Day'] == 'Y')
                {
                    echo '<td>Berevement Day</td>';
                }
                elseif ($item['Is_FMLA_Day'] == 'Y')
                {
                    echo '<td>FMLA Day</td>';
                }
                elseif ($item['Is_Short_Term_Disability_Day'] == 'Y')
                {
                    echo '<td>Short Term Disability Day</td>';
                }
                elseif ($item['Is_Long_Term_Disability_Day'] == 'Y')
                {
                    echo '<td>Long Term Disability Day</td>';
                }
                else
                {
                    echo '<td> </td>';
                }
                echo '<td>' . date('H:i', strtotime($item['RegularTime'])) . '</td>';
                echo '<td>' . date('H:i', strtotime($item['OverTime'])) . '</td>';
                echo '<td>' . date('H:i', strtotime($item['NonWorkTime'])) . '</td>';
                ?>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>

