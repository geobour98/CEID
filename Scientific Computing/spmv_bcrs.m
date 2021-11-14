function y = spmv_bcrs(y,val,col_idx,row_blk,x)

[m,n] = size(val);
 
for i=1:length(row_blk)-1    
    i1 = (row_blk(i)*m)-1; 
    i2 = (row_blk(i+1)*m)-2;
    item = [];
    cnt = (i2-i1+1)/m;
    for j=1:cnt 
        item = [item; x(col_idx(j)*m-1:col_idx(j)*m+m-2)];
    end
    col_idx = col_idx(cnt+1:end);
    y(i*m-m+1:i*m) = y(i*m-m+1:i*m)+val(:,i1:i2)*item;
end
 
end
