<div class="filters-toolbar__limited-view toolbar-col" data-limited-view >
                              <label>Sort By Price:</label>
                              <div class="shop-top">
                            <div class="shop-shorter">
                                 <div class="single-shorter">
                                     
                                                   <script>
                                                       function getval(val)
                                                       {
                                                        //   alert(val);
                                                           window.location = "?range="+val;
                                                       }
                                                   </script>                                         
                                <select id='sort' name='sort'  onchange="getval(this.value);">
                                <option value="">Select</option>
                                  <option id="1" value='1:2000'>1-2000</option>
                                  <option  value='2000:5000'>2000-5000</option>
                                  <option  value='6000:10000'>6000-10000</option>
                                  <option  value='11000:15000'>11000-15000</option>
                                  
                                  <option  value='16000:20000'>16000-20000</option>
                                 
                                  <option  value='21000:25000'>21000-25000</option>
                                  
                                  <option  value='26000:30000'>26000-30000</option>
                                </select>
                                <input type="hidden" name="filter_type" id="filter_type" value="0">
                              </div>

                            <div class="single-shorter" >
                            </div>

                </div> 

              </div>

 </div>