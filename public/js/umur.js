function ageCalculator(lahir,dik) {
    //collect input from HTML form and convert into date format
    var dob = new Date(lahir);

    //extract the year, month, and date from user date input
    var dobYear = dob.getYear();
    var dobMonth = dob.getMonth();
    var dobDate = dob.getDate();

    //get the current date from the system
    var now = new Date(dik);
    //extract the year, month, and date from current date
    var currentYear = now.getYear();
    var currentMonth = now.getMonth();
    var currentDate = now.getDate();

    //declare a variable to collect the age in year, month, and days
    var age = {};
    var ageString = "";

    //get years
    yearAge = currentYear - dobYear;

    //get months
    if (currentMonth >= dobMonth)
      //get months when current month is greater
        var monthAge = currentMonth - dobMonth;
    else {
        yearAge--;
        var monthAge = 12 + currentMonth - dobMonth;
    }

    //get days
    if (currentDate >= dobDate)
      //get days when the current date is greater
        var dateAge = currentDate - dobDate;
    else {
        monthAge--;
        var dateAge = 31 + currentDate - dobDate;
        if (monthAge < 0) {
            monthAge = 11;
            yearAge--;
        }
    }
    //group the age in a single variable
    age = {
    years: yearAge,
    months: monthAge,
    days: dateAge
    };


    if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
        ageString = age.years + " Tahun, " + age.months + " Bulan, dan " + age.days + " hari.";
    else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
        ageString = "Only " + age.days + " hari!";
    //when current month dan date is same as birth date dan month
    else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
        ageString = age.years +  " Tahun.";
    else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
        ageString = age.years + " Tahun dan " + age.months + " Bulan.";
    else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
        ageString = age.months + " Bulan dan " + age.days + " hari.";
    else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
        ageString = age.years + " Tahun, dan" + age.days + " hari.";
    else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
        ageString = age.months + " Bulan.";
    //when current date is same as dob(date of birth)
    else ageString = "Welcome to Earth! <br> It's first day on Earth!";
    //display the calculated age

    return [ageString,age];
}

function ageValidation(data) {
    var year = data.years;
    var month = data.months;
    var day = data.days;

    if ((year<=17 && month<=9) && (year>22 || year==22 && month>0)) {
        return 'Umur tidak memenuhi persyaratan';
    }else{
        return 'Umur memenuhi persyaratan';
    }
}
