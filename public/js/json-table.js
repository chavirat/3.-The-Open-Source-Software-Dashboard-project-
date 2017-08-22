String.prototype.format = function() {
    var args = arguments;

    return this.replace(/{(\d+)}/g, function(match, number) {
        return typeof args[number] != 'undefined' ? args[number] :
            '{' + number + '}';
    });
};
String.prototype.trunc = String.prototype.trunc ||
    function(n) {
        return (this.length > n) ? this.substr(0, n - 1) + '&hellip;' : this;
    };


function create_legend(parsedJson, color){
    var div_legend =[];
    var div_row = '<div class="label-legend">{0}</div>';
    var div_color = '<span class="color-legend" style="background-color:{0};"></span>';
    var div_label = '<div class="label-legend">{0} {1}:{2}</div>';
    var i = 0;
    if(parsedJson){
      for(key in parsedJson){
        var value = parsedJson[key];
        var label = value.label;
        var value = value.value;
        //check decimal
        if(value % 1 != 0) {
          var value = value.toFixed(2);
        }
          var num = numberWithCommas(value);
        div_color_label = div_color.format(color[i]);
        div_legend += div_label.format(div_color_label,label,num);

        i++;
      }
      div_legend = div_row.format(div_legend);
      return div_legend;
    }
    return null;
  }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function create_json(total_files, software_model_files,license_type_files,top5permissive_files,top3copyleftweak_files,top2copyleft_files){

  var node_array = ["Total Files"];
  var files_array = [];
  files_array.push(parseInt(total_files));
  var id_array =["files"];
  var per_file_array = [100];

  for(key in software_model_files){
    var value = software_model_files[key];
    var name = value.software_model.replace("*","");
    var id = name.toLowerCase().replace(/ /g,"_");
    var files = parseInt(value.files);
    var per_file = ((files/total_files)*100).toFixed(2);

    node_array.push(name);
    id_array.push(id);
    files_array.push(files);
    per_file_array.push(per_file);

  }
  for(key in license_type_files){
    var value = license_type_files[key];
    var name = value.license_type.replace("*","");
    var id = name.toLowerCase().replace(/ /g,"_");
    var files = parseInt(value.files);
    var per_file = ((files/total_files)*100).toFixed(2);
    node_array.push(name);
    id_array.push(id);
    files_array.push(files);
    per_file_array.push(per_file);
  }
  node_array.push("No Information License","Client copyright","Free licenses");
  id_array.push("nottyped","client_copyright","free_licenses");
  files_array.push(files_array[6],files_array[10],files_array[11]);
  per_file_array.push(per_file_array[6],per_file_array[10],per_file_array[11]);
  //console.log(node_array + files_array);
  for(key in top5permissive_files){
    var value = top5permissive_files[key];
    var name = value.license_base;
    var id = name.toLowerCase().replace(/ /g,"_").replace("*","");
    var files = parseInt(value.files);
    var per_file = ((files/total_files)*100).toFixed(2);
    node_array.push(name);
    id_array.push(id);
    files_array.push(files);
    per_file_array.push(per_file);
  }
var regexp = /\(([^)]+)\)/;
  for(key in top3copyleftweak_files){
    var value = top3copyleftweak_files[key];
    var name = value.license_base;
    var matches = regexp.exec(name);
    name = matches[1]; //matches[1] contains the value between the parentheses
    var id = name.toLowerCase().replace(/ /g,"_").replace("*","");
    var files = parseInt(value.files);
    var per_file = ((files/total_files)*100).toFixed(2);
    node_array.push(name);
    id_array.push(id);
    files_array.push(files);
    per_file_array.push(per_file);
  }
  for(key in top2copyleft_files){
    var value = top2copyleft_files[key];
    var name = value.license_base;
    var matches = regexp.exec(name);
    name = matches[1];
    var id = name.toLowerCase().replace(/ /g,"_").replace("*","");
    var files = parseInt(value.files);
    var per_file = ((files/total_files)*100).toFixed(2);
    node_array.push(name);
    id_array.push(id);
    files_array.push(files);
    per_file_array.push(per_file);
  }

  arraymove(node_array,3,4);
  arraymove(node_array,10,7);
  arraymove(node_array,11,8);
  arraymove(node_array,11,9);
  arraymove(node_array, 11,10);
  arraymove(id_array,3,4);
  arraymove(id_array,10,7);
  arraymove(id_array,11,8);
  arraymove(id_array,11,9);
  arraymove(id_array, 11,10);
  arraymove(files_array,3,4);
  arraymove(files_array,10,7);
  arraymove(files_array,11,8);
  arraymove(files_array,11,9);
  arraymove(files_array, 11,10);
  arraymove(per_file_array,3,4);
  arraymove(per_file_array,10,7);
  arraymove(per_file_array,11,8);
  arraymove(per_file_array,11,9);
  arraymove(per_file_array, 11,10);
  // console.log(node_array);
  // console.log(id_array);
  // console.log(files_array);
  var sankey_format = '{\n"nodes" :[\n{0}], "links" :[\n{1}]\n}';
  var node_format ='{"node" : {0},\n"name":" {1} : {2}%",\n"id":"{3}"}';
  var link_format = '{"source":{0},\n"target":{1},\n"value":{2}}';
  var node_con =[];
  var link_con =[];
  for(var i = 0; i<node_array.length;i++){
    node_con += node_format.format(i,node_array[i],per_file_array[i],id_array[i]);
    if(i != node_array.length -1){
      node_con = node_con + ","+"\n";
    }
  }
  var source_array = [0,0,0,0,0,1,2,3,4,4,5,5,5,6,7,8,9,9,9,9,9,10,10,10,11,11];
  var target_array = [1,2,3,4,5,6,7,7,8,9,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24];
  var value_array = [files_array[1],files_array[2],files_array[3],files_array[4],
  files_array[5],files_array[6],files_array[2],files_array[3],files_array[8],
  files_array[4],files_array[9],files_array[10],files_array[11],files_array[12],
  files_array[13],files_array[14],files_array[15],files_array[16],files_array[17],
  files_array[18],files_array[19],files_array[20],files_array[21],
files_array[22],files_array[23],files_array[24]];
  for(var i = 0; i< source_array.length;i++){
    link_con += link_format.format(source_array[i],target_array[i],value_array[i]);
    if(i != source_array.length -1){
      link_con = link_con + ","+"\n";
    }
  }

  var data_sankey = sankey_format.format(node_con,link_con);
  //  console.log(data_sankey);
  return data_sankey;
}

function arraymove(arr, fromIndex, toIndex) {
      var element = arr[fromIndex];
      arr.splice(fromIndex, 1);
      arr.splice(toIndex, 0, element);
  }

function create_sankey(json){
  var colors = {
         'open_source': '#943235', //red
         'freeware':  '#D14524', //orange
         'commercial': '#5A3386', //purple
         'in-house': '#5293AD', //lightblue
         'nottyped': '#C0C0C0', //grey
         'copyleft':'#943235', //red
         'copyleft_weak' : '#F4A416', //yellow
         'permissive' : '#2D9F5F', //green
         'public_domain' : '#424094' , //blue
         'proprietary' : '#5A3386'  //purple
       };
    var chart = d3.select("#sankey_chart").append("svg").chart("Sankey.Path");
    chart
      .name(label)
      .colorNodes(function(name, node) {
        return color(node, 1) || colors.fallback;
      })
      .colorLinks(function(link) {
        return color(link.source, 4) || color(link.target, 1) || colors.fallback;
      })
      .nodeWidth(15)
      .nodePadding(10)
      .spread(true)
      .iterations(0)
      .draw(json);
    function label(node) {
      return node.name;
    }
    function color(node, depth) {
      var id = node.id;
      if (colors[id]) {
        return colors[id];
      } else if (depth > 0 && node.targetLinks && node.targetLinks.length == 1) {
        return color(node.targetLinks[0].source, depth-1);
      } else {
        return null;
      }
    }
  };
function jsonToTableLicense(parsedJson, total_audit, insert_table){
  var table = '<table class="table table-striped">{0}</table>';
  var table_header = '<tr><th>License Name</th><th>Frequency</th><th>Percentage</th></tr>';
  var td_name = '<td><a href="#" data-toggle="modal" data-target="#{0}">{1}</a></td>';
  var td_freq = '<td>{0}</td>';
  var td_progress ='<td><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="{0}" aria-valuemin="0" aria-valuemax="100" style="width:{0}%">{0} %</div></div></td>';
  var modal = '<div class="modal fade" id="{0}" tabindex="-1" role="dialog" aria-labelledby="{0}" aria-hidden="true">{1}</div>';
  var modal_dialog_lg = '<div class="modal-dialog modal-lg" role="document"><div class="modal-content">{0}</div></div>';
  var modal_header = '<div class="modal-header"><p class="text-primary"><small>{0}</small></p></div>';
  var modal_body = '<div class="modal-body"><small>{0}</small></div>';
  var modal_footer = '  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>';
  var td_body = '';
  var tr = '<tr>{0}</tr>';
  var tr_body = '';
  var i = 0;
  var modal_content = '';
  var modal_dialog_content = '';
  var modal_all ='';
  if(parsedJson){
    for(key in parsedJson){
      var value = parsedJson[key];
      var license_id = value.license_id;
      var license_name = value.license_name;
      var taxonomy = value.taxonomy;
      var text = value.text;
      var freq = value.freq;
      var occur = value.occur;
      var per_occur = Math.round((parseInt(occur)/total_audit)*100);
      td_body += td_name.format(license_id, license_name);
      td_body += td_freq.format(freq);
      td_body += td_progress.format(per_occur);
      tr_body += tr.format(td_body);
      td_body = '';
      modal_content += modal_header.format(taxonomy);
      modal_content += modal_body.format(text);
      modal_dialog_content += modal_dialog_lg.format(modal_content+modal_footer);
      modal_all += modal.format(license_id, modal_dialog_content);
      modal_content = '';
      modal_dialog_content = '';
    }
    var table_con = table.format(table_header + tr_body);
    var content_top10_licenses_table = table_con + modal_all;
    return document.getElementById(insert_table).innerHTML = content_top10_licenses_table;
  }
  return null;
}
function jsonToTablePackage(parsedJson, total_audit,insert_table){
  var table = '<table class="table table-striped">{0}</table>';
  var table_header = '<tr><th>Package Name</th><th>Percentage</th></tr>';
  var td_name = '<td><a href="#" data-toggle="modal" data-target="#{0}">{1}</a></td>';
  var td_freq = '<td>{0}</td>';
  var td_progress ='<td><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="{0}" aria-valuemin="0" aria-valuemax="100" style="width:{0}%">{0} %</div></div></td>';
  var modal = '<div class="modal fade" id="{0}" tabindex="-1" role="dialog" aria-labelledby="{0}" aria-hidden="true">{1}</div>';
  var modal_dialog = '<div class="modal-dialog" role="document"><div class="modal-content">{0}</div></div>';
  var modal_header = '<div class="modal-header"><h5 class="modal-title">{0}</h5></div>';
  var modal_body = '<div class="modal-body"><p><b><i class="fa fa-home fa-fw"></i> </b><a href="{0}" target="_blank">{0}</a>  </p> <div class="alert alert-info">{1}</div></div>';
  var modal_footer = '  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>';
  var tr = '<tr>{0}</tr>';
  var modal_content = '';
  var modal_dialog_content = '';
  var modal_all ='';
  var td_body = '';
  var tr_body = '';
  if(parsedJson){
    for(key in parsedJson){
      var value = parsedJson[key];
      var package_id = value.package_id.replace(".","-");
      var package_name = value.package_name;
      var homepage_url = value.homepage_url;
      var description = value.description;
      var freq = value.freq;
      var occur = value.occur;
      var per_occur = Math.round((parseInt(occur)/total_audit)*100);
      td_body += td_name.format(package_id, package_name);
      //td_body += td_freq.format(freq);
      td_body += td_progress.format(per_occur);
      tr_body += tr.format(td_body);
      td_body = '';
      modal_content += modal_header.format(package_name);
      modal_content += modal_body.format(homepage_url, description);
      modal_dialog_content += modal_dialog.format(modal_content+modal_footer);
      modal_all += modal.format(package_id, modal_dialog_content);
      modal_content = '';
      modal_dialog_content = '';
    }
    var table_con = table.format(table_header + tr_body);
    var content_top10_packages_table = table_con + modal_all;
    return document.getElementById(insert_table).innerHTML = content_top10_packages_table;
  }
  return null;
}
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
