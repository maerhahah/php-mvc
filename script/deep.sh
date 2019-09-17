#!/bin/bash

f=''
# 生成随机数作为零食文件名
for n in 1 2 3 4 5 6 7 8 9 10; do
    random=$(( (RANDOM % 10) + 1 ))
    f=`echo -n $f"$random"`
done
#echo $f;
touch $f

echo "$1" > $f

file=$f
num=1;
#echo 'file:'$file

# 删除空行免干扰
sed -i '/^$/d' $file

while true
do 
#    echo 'num:'$num;
    n1=`sed -n $num'p' ${file}`;

#    如果获取到空行就跳出循环
    if [ -z "$n1" ];then
   	break;
    fi
    
#     依赖者   
    w1=`echo $n1 | awk -F" " '{print $1}'`
#     被依赖者
    w2=`echo $n1 | awk -F" " '{print $2}'`
    
#    echo $w1;
#    echo $w2;
    
    if [ -z "$w2" ];then
	`sed -i "${num}d" $file`
 	continue;   	
    fi	    

#     统计当前依赖着是否也直接被依赖
    ret=`sed -n "/ $w1/p" $file | wc -l`
#    echo 'ret1:'$ret 
    
#     如果被依赖    、
    if [ 0 -ne $ret ];then
#        检测下一行
    	((num=num+1));	
   
#    如果没有被依赖
    else
#	如果没有被依赖就去除当前的节点，去除节点后行数有从头开始
	num=1;
	`sed -i "/$w1 /d" $file`
    fi
done;

#返回结果
echo `cat $file | wc -l`;

#删除临时文件
rm -f $file
