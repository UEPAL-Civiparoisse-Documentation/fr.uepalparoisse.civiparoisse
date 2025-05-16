async function civiparoisse_handle_hvaddrdialog(event,data)
{
  event.stopPropagation();

  var frResult=await CRM.api4('Country', 'get', {
    select: ["id"],
    where: [["iso_code", "=", "FR"]],
    limit: 1
  });
  var frId = frResult[0].id;
  var deptResult=await CRM.api4('StateProvince', 'get', {
    select: ["id"],
    where: [["country_id.iso_code", "=", "FR"], ["abbreviation", "=", data.dept]],
    limit: 1
  });
  var deptId = deptResult[0].id;

  if (typeof data.dept !== 'undefined') {
    CRM.$('select[name="country_id"]').val(frId);
    CRM.$('select[name="country_id"]').trigger('change');
    CRM.$('select[name="state_province_id"]').val(deptId);
    CRM.$('select[name="state_province_id"]').trigger('change');

    if (typeof data.city !== 'undefined') {
      CRM.$('input[name="city"]').val(data.city);
    }

    if (typeof data.postcode !== 'undefined') {
      CRM.$('input[name="postal_code"]').val(data.postcode);
    }

    if (typeof data.street !== 'undefined') {
      var aggregated = ((typeof data.numrep !== 'undefined') ? data.numrep + ', ' : '') + data.street;
      CRM.$('input[name="street_address"]').val(aggregated);
    }
  }
}

CRM.$(function ($) {
  $('div.addrvirtualcontainer').on('hvaddrdialog', civiparoisse_handle_hvaddrdialog );
});
