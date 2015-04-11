function LoadDate(dayId, monthId, yearId, day, month, year)
{
	LoadYear(yearId, year);
	LoadMonth(monthId, month);
	LoadDay(dayId, monthId, yearId, day);
}

function LoadYear(yearId, year)
{
	var yearCtrl = document.getElementById(yearId);
	var yearInt = year * 1;
	
	for(i = yearInt - 10; i < yearInt + 10; i++)
	{
		var anOption = new Option(i, i);
		yearCtrl.options[yearCtrl.options.length] = anOption;
	}

	yearCtrl.selectedIndex = 10;
}

function LoadMonth(monthId, month)
{
	var monthCtrl = document.getElementById(monthId);
	var monthInt = month * 1;
	
	for(i = 1; i < 13; i++)
	{
		var anOption = new Option(i, i);
		monthCtrl.options[monthCtrl.options.length] = anOption;
	}

	monthCtrl.selectedIndex = monthInt - 1;
}

function LoadDay(dayId, monthId, yearId, day)
{
	var dayCtrl = document.getElementById(dayId);
	var monthCtrl = document.getElementById(monthId);
	var yearCtrl = document.getElementById(yearId);
	
	var year = yearCtrl.options[yearCtrl.selectedIndex].value;
	var month = monthCtrl.options[monthCtrl.selectedIndex].value;
	var dayInt = day * 1;
	
	var numberOfDays = 0;
	
	if(YearIsLeap(year * 1) && month == '2')
	{
		numberOfDays = 29;
	}
	else
	{
		switch(month * 1)
		{
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				numberOfDays = 31;
			break;
			case 2:
				numberOfDays = 28;
			break;
			case 4:
			case 6:
			case 9:
			case 11:
				numberOfDays = 30;
			break;
		}
	}
	
	dayCtrl.options.length = 0;
	
	for(i = 1; i < numberOfDays + 1; i++)
	{
		var anOption = new Option(i, i);
		dayCtrl.options[dayCtrl.options.length] = anOption;
	}
	
	if(typeof(day) != 'undefined')
	{
		dayCtrl.selectedIndex = dayInt - 1;
	}
}

function YearIsLeap(year)
{
	if(year % 4 == 0)
	{
		if(year % 100 == 0)
		{
			if(year % 400 == 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
	}
	else
	{
		return false;
	}
}