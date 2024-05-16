<?php Controller::secure() ?>

<h1>Editieren</h1>

<?php
$html = '<form method="post"><table >
          <thead> 
             <tr><th>Event</th><th>Termin</th><th> </th></tr>
         </thead>';
$html .= '<tbody>';         
foreach($data as $spalte){
    $html .= '<tr>';
    $html .= '<td>'.$spalte['event'].'</td><td>'.date('d.m.y H:i',strtotime($spalte['time'])).'</td>';
    $html .=  '<td><input type="checkbox" name="del[]" value="'.$spalte['id'].'"></td>';
    $html .= '</tr>';
}
$html .= '<tr><td></td><td></td><td><button>löschen</button></td>';
$html .= '</tbody></table></form>';
echo $html;
?>


<form method="post">
    <input type="text" name="event"  placeholder="hier Event eingeben" required>
    <input type="datetime-local" name="time">
    <input type="hidden" name="add_event" value="true">
    <button>hinzufügen</button>
</form>