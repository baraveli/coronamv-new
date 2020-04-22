<div class="shadow-sm p-3 mt-2 mb-5 bg-white rounded text-right">
    <h4 class="divtype o-90" style="font-size: 19px;color: #3A3A56;">ރާއްޖެއަށް ދަތުރުފަތުރު ކުރުންމަނާ
      ޤައުމުތަށް</h4>
    <hr class="o-70" />
    <p class="o-90"
      style="font-family: mvtyper; font-size: 15px; direction: rtl; text-align: right; color: #3A3A56;">
      އެއްވެސް ފަސިންޖަރަކު މިއިންތަނަކުން ފުރައިގެން ނުވަތަ އެތަނުގައި/އެޤައުމުގައި ޓްރާންސްޒިޓްވެފައިވާ ކަމަށް
      އެ ފަސިންޖަރެއް އެންމެފަހުން ދަތުރުކުރި ތަންތަނުގެ ލިސްޓުގައި ހިމެނޭނަމަ އެ ފަސިންޖަރަކު ރާއްޖެ
      އެތެރެވުމުގެ ހުއްދައެއް ނުދެވޭނެއެވެ.</p>
    <br>
    <p class="o-90"
      style="font-family: mvtyper; font-size: 15px; direction: rtl; text-align: right; color: #3A3A56;">
      ކަންމިހެން އޮތްނަމަވެސް، ދިވެހިންނާއި ދިވެއްސެއްގެ އަނބިންނާއި ފިރިން ރާއްޖެ އެތެރެވުމަށް
      ހުއްދަކުރެވޭނެއެވެ. ނަމަވެސް މިގޮތަށް ހުއްދަކުރާއިރު އެފަރާތްތައް ކަރަންޓީނުކުރުންފަދަ އަޅަނަޖެހޭ
      ފިޔަވަޅުތައް އެޅޭނެއެވެ.</p>


    <ul class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-center"
        v-for="ban in maldives.travel_bans" style="color: #3A3A56;">
        <p class="o-90" style="font-size: 14px; text-align: center; color: #3A3A56;"> @{{ban.date}}</p>
        <span class="badge badge-pill divtype ban-name"> @{{ban.name}}</span>
      </li>

    </ul>

  </div>