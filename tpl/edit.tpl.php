<h1>Editieren</h1>

<?php
$html = '<table>
          <thead> 
             <tr><th>Event</th><th>Termin</th></tr>
         </thead>';
$html .= '<tbody>';         
foreach($data as $spalte){
    $html .= '<tr>';
    $html .= '<td>'.$spalte['event'].'</td><td>'.date('d.m.y H:i',strtotime($spalte['time'])).'</td>';
    $html .= '</tr>';
}
$html .= '</tbody></table>';
echo $html;
?>



<form method="post">
    <input type="text" name="event"  placeholder="hier Event eingeben" require>
    <input type="datetime-local" name="time">
    <input type="hidden" name="add_event" value="true">
    <button>hinzufügen</button>
</form>