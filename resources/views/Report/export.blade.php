<table>
                                                <thead>
                                                    <tr>
                                                    <th>ID</th>
                                                    <th>Menu</th>
                                                    <th>Table</th>
                                                    <th>Servant</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Payment_Type</th>
                                                    <th>Payment_status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($sales as $key=> $sale )
                                                    <tr>
                                                        <td>{{$key+=1}}</td>
                                                        <td>
                                                            @foreach ($sale->menus()->where('sale_id',$sale->id)->get()
                                                            as $item )
                                                           
                                                                        <h5>
                                                                            {{$item->title}}
                                                                        </h5>


                                                                  



                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($sale->tables()->where('sale_id',$sale->id)->get()
                                                            as $item )
                                                           
                                                                        
                                                                       

                                                                        <h5>
                                                                            {{$item->name}}
                                                                        </h5>


                                                                   



                                                            @endforeach
                                                        </td>
                                                        <td>{{$sale->servant->name}}</td>
                                                        <td>{{$sale->quantity}}</td>
                                                        <td>{{$sale->total_price}}</td>
                                                        <td>{{$sale->payment_type}}</td>
                                                        <td>{{$sale->payment_status}}</td>



                                                    </tr>
                                                    @endforeach
                                                    <hr>
                                                    <hr>
                                                    <tr>
                                                        <td colspan="5">
                                                           Report from {{$from}}  to {{$to}} 
                                                        </td>
                                                        <td>{{$total}} dh</td>
                                                    </tr>

                                                </tbody>

                                            </table>