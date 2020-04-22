<!-- Level Card start-->
<div class="shadow-sm text-right mt4 p-3 mb-5 bg-white rounded">

    <b-list-group flush>
      <h3 class="fw4 ttu mv0 dib bg-white ph3 o-90"
        style="font-family:Mvaamu; color: #3A3A56; font-size: 23px;">

        ލެވެލް<span style="margin-left:5px;"><img src="https://image.flaticon.com/icons/svg/439/439183.svg"
            class="icon-size"></span>
      </h3>

      <p class="o-90"
        style="font-family: mvtyper; font-size: 14px; direction: rtl; text-align: right; color: #3A3A56;">
        އާންމު ޞިއްޙަތުގެ ނުރައްކާތެރިކަން އޮތް މިންވަރު ކަނޑަޅާ މިންގަނޑުތައް</p>


      <b-list-group-item v-for="risk in maldives.risks">
        <h6 style="font-family:mvtyper; color: #3A3A56;direction:rtl; font-weight:bold; font-size:14px;"
          class="o-90">
          @{{risk.name}}: <b>ލެވެލް  @{{risk.level}}</b>
          <div class="btn btn-sm" style="border-radius: 40px;" :class="risk.class">
            <b> @{{risk.alert}}</b></div>
        </h6>
      </b-list-group-item>
    </b-list-group>

  </div>
  <!-- Level Card End-->