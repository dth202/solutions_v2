/**
 * Creats an AJAX object.
 */
function createAjaxObject()
{
    var ajaxObject;
    if(XMLHttpRequest) {
        // Standard method
        ajaxObject = new XMLHttpRequest();
    }
    else {
        // IE proprietary craphola
        ajaxObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return ajaxObject;
}

/**
 * Uses AJAX to fetch the data for, and create, the Items dropdown.
 */
function getItems()
{
    // Get the selected group
    var groupID = document.getElementById('companies_id').value;

    // Get the Items select box
    var itemsSelect = document.getElementById('Items');

    // Validate the groupID
    if(isNaN(parseInt(groupID)))
    {
       // The value isn't a valid group ID
       // Hide the items select and stop the function
       itemsSelect.style.display = "none";
       return;
    }

    // Create a new AJAX object
    var ajax = createAjaxObject();

    // Set the code to be exected when the
    // AJAX call is complete.
    ajax.onreadystatechange = function()
    {
        // Make sure the AJAX call was successful
        if(ajax.readyState == 4) {
            // Clear the box of any old options
            itemsSelect.options.length = 0;

            // Add a -Select- option to the box
            var option = new Option("-Select-", "");
            itemsSelect.options.add(option);

            // Get the response text and split it into groups
            var response = ajax.responseText;
            var groups = response.split("\n");

            // Add each group to the items select box
            for(var i = 0; i < groups.length; i++)
            {
                // Split the group into the ID and Name, and validate them
                var parts = groups[i].split(",");
                if(parts.length == 2)
                {
                    // Create and add an option to the select
                    option = new Option(parts[1], parts[0]);
                    itemsSelect.options.add(option);
                }

            }

            // Make the select visible
            itemsSelect.style.display = "inline-block";
        }
        else {
            // Hide the select
            itemsSelect.style.display = "none";
        }
    }

    // Execute the AJAX call
    ajax.open("GET", "getItems.php?gid=" + groupID, true);
    ajax.send(null);
}