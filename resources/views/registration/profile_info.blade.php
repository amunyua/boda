
<fieldset>
    <section class="col col-6">
        <ul class="unstyled span10; font-sm">
            <li><span>Full Name: </span><span style="color: #00a300">{{ $mf->surname.' '.$mf->firstname.' '.$mf->middlename }}</span></li>
            <li><span>User Role: </span><span style="color: #00a300">{{ $mf->b_role }}</span> </li>
            <li><span>Gender: </span><span style="color: #00a300">{{ ($mf->gender == 1) ? 'Male' : 'Female' }}</span> </li>
            <li><span>Start Date: </span><span style="color: #00a300">{{ $mf->registration_date }}</span> </li>
            <li><span>Business Role: </span><span style="color: #00a300">{{ $mf->b_role }}</span> </li>
            <li><span>Email address: </span><span style="color: #00a300">{{ $addr->email }}</span> </li>
            <li><span>ID No/Passport: </span><span style="color: #00a300">{{ $mf->id_no }}</span> </li>
        </ul>
    </section>
</fieldset>


